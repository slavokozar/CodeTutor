<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 15/08/2017
 * Time: 15:13
 */

namespace App\Http\Controllers\Assignments;


use App\Http\Controllers\Controller;
use App\Models\Assignments\Solution;
use App\Models\Assignments\SolutionFile;
use Chumper\Zipper\Facades\Zipper;
use Facades\App\Services\Assignments\AssignmentService;
use Facades\App\Services\Assignments\SolutionService;
use Facades\App\Services\Assignments\SubmitService;
use Facades\App\Services\Users\UserService;
use Facades\App\Services\Utils\CleanString;
use Facades\App\Services\Utils\UniqueCode;
use FileUpload\FileNameGenerator;
use FileUpload\FileSystem;
use FileUpload\FileUploadFactory;
use FileUpload\PathResolver;
use FileUpload\Validator\SizeValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class SubmitController extends Controller
{
    private $hiddenFilesRegex = '^((.*_edited\.(c|c++|java))|main\.sh|result\.json|wrapper|__.*)$';

//    public function __construct(){
//        $this->middleware('auth');
//    }

    public function index($assignment)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        $solution = $assignmentObj->solutions()->orderBy('created_at', 'desc')->first();

        return view('assignments.submit.index', compact(['assignmentObj','solution']));
    }


    public function show($assignment, $solution)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $solutionObj = $assignmentObj->solutions()->where('code', $solution)->first();

        return $solutionObj->with('files');
//        $solutionObj = SolutionService::last(A, $assignmentObj);
//
//        if ($solutionObj) {
//            $scores = $solutionObj->scores;
//            $scoresPoints = $scores->sum('points');
//            $reviews = $solutionObj->reviews;
//            $reviewsPoints = $reviews->sum('points');
//        }
//
//        $files = SolutionService::currentFiles($userObj, $assignmentObj);
//        $resultFile = SolutionService::currentHasResultFile($userObj, $assignmentObj);

        return view('assignments.submit.show', compact(['assignmentObj', 'solutionObj', 'files', 'resultFile']));
    }


    public function upload($assignment, Request $request)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        $pathUserTemp = UserService::pathTemp(Auth::user());
        if (!File::exists($pathUserTemp)) File::makeDirectory($pathUserTemp);

        $pathUserTemp = UniqueCode::uniqueFolder($pathUserTemp);
        if (!File::exists($pathUserTemp)) File::makeDirectory($pathUserTemp);



//        try {
            $fileObj = null;

            $factory = new FileUploadFactory(new PathResolver\Simple($pathUserTemp),
                new FileSystem\Simple(), [
                    new SizeValidator("10M"),
                ]
            );

            $fileupload = $factory->create($_FILES['file'], $_SERVER);

            // generate unique file names based on original file name
            $filenamegenerator = new FileNameGenerator\Simple();
            $fileupload->setFileNameGenerator($filenamegenerator);

            // Doing the deed
            list($files, $headers) = $fileupload->processAll();

            // Outputting it, for example like this
            foreach ($headers as $header => $value) {
                header($header . ': ' . $value);
            }

            if ($files[0]->completed) {

                $filename = $files[0]->name;

                $pathFile = $pathUserTemp . '/' . $filename;

                $extension = File::extension($pathFile);
                $mime = File::mimeType($pathFile);

                // rozbalim ak je to zipko
                if ($extension == 'zip' && $mime == 'application/zip') {

                    $pathUserTemp = UniqueCode::uniqueFolder($pathUserTemp);
                    Zipper::make($pathFile)->extractTo($pathUserTemp);
                }

                $langObj = SubmitService::getLangObj($pathUserTemp);


//                return $langObj;

//                if ($langObj === null) {
//                    return json_encode((object)[
//                        'files' => [
//                            (object)[
//                                'error' => 'The uploaded file does not contain valid solution'
//                            ]
//                        ]
//                    ]);
//                }

                $solutionPath = AssignmentService::pathSolution($assignmentObj, Auth::user());

                // presuniem aktualne riesenie do archivu
                $solutionObj = SolutionService::last($assignmentObj, Auth::user());
                if ($solutionObj != null) {
                    $archivePath = AssignmentService::pathArchive($assignmentObj, Auth::user());
                    $path = $archivePath . '/' . strtotime($solutionObj->created_at);

                    File::copyDirectory($solutionPath, $path);
                    File::cleanDirectory($solutionPath);
                }


                File::copyDirectory($pathUserTemp, $solutionPath); // presuniem validne riesenie z tempu
                File::cleanDirectory($pathUserTemp); // zmazem uzivatelov temp

                do {
                    $code = UniqueCode::generate(8);
                } while (Solution::where('code', $code)->count() > 0);


                $solutionObj = SolutionService::store([
                    'user_id' => Auth::user()->id,
                    'code' => $code,
                    'assignment_id' => $assignmentObj->id,
                    'filename' => $filename,
                    'lang_id' => $langObj ? $langObj->id : null
                ]);

                $files = File::allFiles($solutionPath);
                foreach ($files as $file) {
                    $file = str_replace($solutionPath,'', (string)$file);

                    $normalized = CleanString::normalize($file);
                    $normalized = ltrim($normalized, '/');
                    $normalized = preg_replace(['/\s/', '/\./', '/\//'], '-', $normalized);

                    do {
                        $code = UniqueCode::generate(6) . '-' . $normalized;
                    } while (SolutionFile::where('solution_id', $solutionObj->id)->where('code', $code)->count() > 0);

                    $pathinfo = pathinfo($file);
                    SolutionFile::create([
                        'solution_id' => $solutionObj->id,
                        'code' => $code,
                        'dirname' => $pathinfo['dirname'],
                        'filename' => $pathinfo['filename'],
                        'ext' => $pathinfo['extension']
                    ]);
                }


                return $solutionObj;

            } else {
                return json_encode(['files' => $files]);
            }
//        } catch (\Exception $e) {
//            return $e;
//            return response($e->getMessage(), 500);
//        }

    }

    public function source($assignment, $file = null)
    {

    }

    public function history($assignment)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        $solutions = $assignmentObj->solutions()->where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();

        return view('assignments.submit.history', compact(['assignmentObj','solutions']));
        return $solutions;
    }
}