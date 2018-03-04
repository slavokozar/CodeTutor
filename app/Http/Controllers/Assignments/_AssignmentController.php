<?php

namespace App\Http\Controllers\Assignments;

use App\_Classes\Parsedown;
use App\Facades\TestsServiceFacade;
use App\_Classes\UUID;
use App\Facades\CleanString;
use App\Facades\RequestServiceFacade;
use App\Facades\TesterServiceFacade;
use App\Facades\UploadServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use App\Models\Assignment;
use App\Models\AssignmentSolution;
use App\Models\Group;
use App\Models\User;

use Exception;
use FileUpload\FileUpload;
use FileUpload\Validator\Simple;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\ContentRangeUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use RequestService;
use Validator;

class _AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }



    //    .*_edited\.(c|c++|java)
    //    main\.sh
    //    result.json
    //    wrapper
    private $hiddenFilesRegex = '^((.*_edited\.(c|c++|java))|main\.sh|result\.json|wrapper|__.*)$';


    public function test(Request $request, $code, $user = null)
    {
        $assignment = Assignment::where('code', $code)->first();

        if ($user != null && $assignment->group->isLecturer(Auth::user())) {
            $user = User::where('code', $user)->first();
        } else {
            $user = Auth::user();
        }

        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignment->code . '/users/' . $user->code;


        $lang = $this->getLang($assignmentPath);

        if ($lang == '') {
            abort(500);
        }

        $filename = AssignmentSolution::where('user_id', $user->id)->where('assignment_id', $assignment->id)->get()->last()->filename;

        $solution = AssignmentSolution::create([
            'user_id' => $user->id,
            'assignment_id' => $assignment->id,
            'filename' => $filename,
            'lang' => $lang
        ]);


        $task_id = '';
        $test = TesterServiceFacade::start($solution->id);

        if ($test != false) {
            $task_id = json_decode($test)->task_id;


            $tests = Session::get('tests', []);
            $tests[] = $task_id;
            Session::put('tests', $tests);
        }

        return $task_id;
    }

    public function status(Request $request, $code)
    {
        $testId = $request->get('test');
        $tests = Session::get('tests', []);
        //tod overit, ci uzivatel zacal test s testId

        $status = [];

        if (array_search($testId, $tests) === false) {
            abort(400);
        }

        $response = TesterServiceFacade::status($testId);


        if ($response != '') {
            $response = json_decode($response);

            $status['status'] = $response->status;
            $status['public'] = $response->public;
            $status['progress'] = $response->progress;


            if ($status['status'] == 'ERROR' || $status['status'] == 'FINISHED') {
                $drop = TesterServiceFacade::drop($testId);
                if ($drop) {
                    $status['dropped'] = true;
                }


                while (($key = array_search($testId, $tests)) !== false) {
                    unset($tests[$key]);
                }
                Session::put('tests', $tests);

                $status['tests'] = $tests;
            }
        }

        return $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        $assignments = [];

        foreach ($groups as $group) {
            foreach ($group->assignments as $assignment) {
                $assignments[] = $assignment;
            }
        }

        return view('assignments.index', compact(['groups', 'assignments']));
    }


    public function show($code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();

        if ($assignmentObj == null) {
            return redirect(action('Assignments\AssignmentController@index'));
        }

        $Parsedown = new Parsedown();
        $content = $Parsedown->text($assignmentObj->text);

        $comments = $assignmentObj->comments()->limit(5)->get();

        $datapub = TestsServiceFacade::datapubToString($assignmentObj);

        return view('assignments.show', compact(['assignmentObj', 'content', 'datapub', 'comments']));
    }


    public function create()
    {
        $assignmentObj = new Assignment();
        $groups = Group::all();
        return view('assignments.edit', compact(['assignmentObj', 'groups']));
    }

    public function store(AssignmentRequest $request)
    {
        $normalized = CleanString::normalize($request->name);

        do {
            $code = new UUID;
            $code = $code->limit(6, 4);
            $code = $normalized . '-' . $code;
        } while (count(Assignment::where('code', $code)->get()) > 0);

        File::makeDirectory(env('TEST_PATH') . '/' . $code);
        File::makeDirectory(env('TEST_PATH') . '/' . $code . '/test');
        File::makeDirectory(env('TEST_PATH') . '/' . $code . '/users');

        $assignmentObj = Assignment::create([
            'name' => $request->name,
            'code' => $code,
            'is_public' => $request->is_public ? true : false,

            'group_id' => $request->group,
            'author_id' => Auth::user()->id,
            'series_id' => null,
            'series_order' => null,

            'description' => $request->description,
            'text' => $request->text,

            'start_at' => date('Y-m-d H:i:s', strtotime($request->start)),
            'deadline_at' => date('Y-m-d H:i:s', strtotime($request->deadline)),
        ]);

        return redirect(action('Assignments\AssignmentController@show', [$assignmentObj->code]));
    }

    public function edit($code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();
        $groups = Group::all();
        return view('assignments.edit', compact(['assignmentObj', 'groups']));
    }

    public function update(AssignmentRequest $request, $code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();

        if ($request->name != $assignmentObj->name) {
            $normalized = CleanString::normalize($request->name);
            do {
                $code = new UUID;
                $code = $code->limit(6, 4);
                $code = $normalized . '-' . $code;
            } while (count(Assignment::where('code', $code)->get()) > 0);

            $assignmentObj->name = $request->name;
            $assignmentObj->code = $code;
        }

        $assignmentObj->group_id = $request->group;
        $assignmentObj->is_public = $request->is_public ? true : false;


        $assignmentObj->description = $request->description;
        $assignmentObj->text = $request->text;

        $assignmentObj->start_at = $request->start;
        $assignmentObj->deadline_at = $request->deadline;

        $assignmentObj->save();

        return redirect(action('Assignments\AssignmentController@show', [$assignmentObj->code]));
    }

    public function solutions($code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();

        $testPath = env('TEST_PATH') . '/' . $assignmentObj->code . '/test/' . env('TEST_FILE');

        if (!File::exists($testPath)) {
            $errors = ['TestFile not found!'];
            return view('assignments.solutions', compact(['assignmentObj', 'errors']));

        }

        $contents = File::get($testPath);
        $tests = json_decode($contents);

        $tasksCount = $tests->tests[0]->output->tasksCount;

        $tasksMaxPoints = [];
        $maxPoints = 0;
        for ($i = 0; $i < $tasksCount; $i++) {
            $linesCount = $tests->tests[0]->output->tasks[$i]->linesCount;
            $tasksMaxPoints[$i] = 0;
            for ($j = 0; $j < $linesCount; $j++) {
                $tasksMaxPoints[$i] += $tests->tests[0]->output->tasks[$i]->lines[$j]->points;
            }
            $maxPoints += $tasksMaxPoints[$i];
        }

        return view('assignments.solutions', compact(['assignmentObj', 'testsCount', 'tasksCount', 'tasksMaxPoints', 'maxPoints']));
    }

    public function userSolution($code, $user)
    {
        $user = User::where('code', $user)->first();
        $assignmentObj = Assignment::where('code', $code)->first();


        $path = env('UPLOAD_ASSIGNMENT') . '/' . $assignmentObj->code . '/users/' . $user->code;
        $files = $this->filesList($path);
        $solution = $assignmentObj->userSolutions()->last();
        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignmentObj->code . '/users/' . $user->code;
        $resultFile = File::exists($assignmentPath . '/' . env('RESULTS_FILE'));

        return view('assignments.userSolution', compact(['assignmentObj', 'files', 'solution', 'resultFile']));
    }


    public function submit($code)
    {
        $user = Auth::user();
        $assignmentObj = Assignment::where('code', $code)->first();

        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignmentObj->code . '/users/' . $user->code;
        $files = $this->filesList($assignmentPath);

        $solution = $assignmentObj->userSolutions()->last();

        if ($solution) {
            $scores = $solution->scores;
            $scoresPoints = $scores->sum('points');
            $reviews = $solution->reviews;
            $reviewsPoints = $reviews->sum('points');
        }

        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignmentObj->code . '/users/' . $user->code;
        $resultFile = File::exists($assignmentPath . '/' . env('RESULTS_FILE'));

        return view('assignments.submit', compact(['assignmentObj', 'files', 'solution', 'resultFile']));
    }

    /**
     * @param Request $request
     * @param $code
     * @return string
     */
    public function upload(Request $request, $code)
    {
        $user = Auth::user();
        $assignment = Assignment::where('code', $code)->first();

        if ($request->session()->has('upload_id')) {
            $uploadId = $request->session()->get('upload_id');
        } else {
            $uploadId = $uniqid = uniqid($user->id . $assignment->code);
            $request->session()->put('upload_id', $uploadId);
        }

        $validator = $this->createFileAttachmentValidator(Input::file('files'));
        if ($validator->fails()) {
            return json_encode(['files' => [
                0 => [
                    'completed' => false,
                    'name' => Input::file('files')->getClientOriginalName(),
                    'size' => Input::file('files')->getClientSize(),
                    'type' => Input::file('files')->getMimeType(),
                    'error' => $validator->messages()->get('extension')[0],
                ]
            ]]);
        }

        $validator = new Simple("100M", [
            'application/zip',
            'text/plain',
            'text/x-java-source',
            'text/x-c',
            'application/x-compressed',
            'application/x-zip-compressed',
            'multipart/x-zip',
            'application/octet-stream'
        ]);

        $uploadPath = env('UPLOAD_TEMP') . '/' . $uploadId;
        $this->verifyPath($uploadPath);

        $pathresolver = new \FileUpload\PathResolver\Simple($uploadPath);

        // The machine's filesystem
        $filesystem = new \FileUpload\FileSystem\Simple();

        // FileUploader itself
        $fileupload = new FileUpload($_FILES['files'], $_SERVER);

        // Adding it all together. Note that you can use multiple validators or none at all
        $fileupload->setPathResolver($pathresolver);
        $fileupload->setFileSystem($filesystem);
        $fileupload->addValidator($validator);

        // Doing the deed
        list($files, $headers) = $fileupload->processAll();

        // Outputting it, for example like this
        foreach ($headers as $header => $value) {
            header($header . ': ' . $value);
        }

        if ($files[0]->completed) {
            $file = $files[0];
            $assignmentCode = $assignment->code;
            $solutionLast = $assignment->solutions()->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

            $uploadPath = env('UPLOAD_TEMP') . '/' . $uploadId;
            $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignment->code . '/users/' . $user->code;

            if ($solutionLast) {
                $archivePath = env('UPLOAD_ARCHIVE') . '/' . $assignment->code . '/users/' . $user->code . '/' . $solutionLast->code;

                $this->verifyPath($archivePath);

                File::moveDirectory($assignmentPath, $archivePath);
            }


            File::cleanDirectory($assignmentPath);

            $this->verifyPath($assignmentPath);

            $ext = pathinfo($file->name)['extension'];
            if ($ext == 'zip') {

                $zipper = new \Chumper\Zipper\Zipper;
                $zipper->zip($file->path)->extractTo($assignmentPath);

            } else {

                $files = File::files($uploadPath);
                foreach ($files as $item) {
                    rename($item, $assignmentPath . '/' . pathinfo($item)['basename']);
                }
            }

            File::deleteDirectory($uploadPath);
            $request->session()->forget('upload_id');

            $lang = $this->getLang($assignmentPath);

            $solution = AssignmentSolution::create([
                'user_id' => $user->id,
                'assignment_id' => $assignment->id,
                'filename' => $file->name,
                'lang' => $lang
            ]);

            if ($lang == '') {
                abort(406, "No source code found!");
            }


            $task_id = 0;


            $test = TesterServiceFacade::start($solution->id);

            if ($test != false) {
                $task_id = json_decode($test)->task_id;


                $tests = Session::get('tests', []);
                $tests[] = $task_id;
                Session::put('tests', $tests);

                return json_encode(['files' => $this->filesRecursive($assignmentPath), 'test' => $task_id, 'tests' => $tests]);
            }


            return json_encode(['files' => $this->filesRecursive($assignmentPath), 'test' => $task_id]);
        } else {
            return json_encode(['files' => $files]);
        }
    }

    public function saveFile(UploadedFile $file, $filename)
    {
        // build the file names
        $fileName = $file->getFilename();

        // do want you want
    }

    /**
     * @param $file
     *
     * @return \Illuminate\Validation\Validator
     */
    private function createFileAttachmentValidator($file)
    {
        $validator = Validator::make(
            [
                'extension' => strtolower($file->getClientOriginalExtension()),
            ],
            [
                'extension' => 'required|in:c,cpp,java,zip',
            ],
            [
                'extension.in' => 'Filetype not allowed.'
            ]
        );

        return $validator;
    }


    public function result(Request $request, $code)
    {
        $user = Auth::user();

        $assignment = Assignment::where('code', $code)->first();
        $assignmentPath = env('UPLOAD_ASSIGNMENT') . '/' . $assignment->code . '/users/' . $user->code;

        if (File::exists($assignmentPath . '/' . env('RESULTS_FILE'))) {
            $contents = File::get($assignmentPath . '/' . env('RESULTS_FILE'));

            $result = json_decode($contents);

            return view('assignments.results', compact(['result']));
        } else {
            abort(404);
        }
    }

    private function verifyPath($path)
    {
        $folders = explode('/', $path);
        $path = "";

        foreach ($folders as $folder) {
            if ($folder == "") continue;
            $path .= '/' . $folder;

//            echo $path;
//            echo '<br/>';

            if (!File::exists($path)) {
                File::makeDirectory($path);
            }
        }

    }


    private function filesRecursive($dir)
    {
        $array = [];

        $directories = File::directories($dir);
        foreach ($directories as $directory) {
            $dirname = str_replace($dir . '/', '', (string)$directory);
            if (preg_match("/^__.*/", $dirname) == 0) {
                $array[] = (object)[
                    'name' => $dirname,
                    'files' => $this->filesRecursive((string)$directory)
                ];
            }
        }
        $files = File::files($dir);
        foreach ($files as $file) {
            $filename = str_replace($dir . '/', '', (string)$file);
            if (preg_match("/^__.*/", $filename) == 0) {
                $array[] = (object)[
                    'name' => $filename
                ];
            }
        }

        return $array;
    }


    // .c and .cpp files look for in route
    // .java
    private function getLang($dir)
    {
        $lang = '';

        $files = File::files($dir);
        foreach ($files as $file) {
            $filename = pathinfo($file)['basename'];
            if($filename == 'Main.java'){

                File::makeDirectory($dir . '/Main');
                File::move($file, $dir . '/Main/' . $filename );

            }else{
                $ext = pathinfo($file)['extension'];
                if($ext == 'c'){
                    return 'c';
                }elseif($ext == 'cpp'){
                    return 'c++';
                }
            }
        }

        $directories = File::directories($dir);
        foreach ($directories as $directory) {
            $dirname = str_replace($dir . '/', '', (string)$directory);

            $files = File::files($directory);
            foreach ($files as $file) {
                $filename = pathinfo($file)['basename'];
                if ($dirname == 'Main' && $filename == 'Main.java') {
                    return 'java';
                }
            }
        }
        return $lang;
    }

    private
    function copyDirectory($dir, $dest)
    {
        echo $dir;
        $lang = '';

        $directories = File::directories($dir);
        foreach ($directories as $directory) {
            $tmp = $this->copyDirectory((string)$directory, $dist);
            if ($tmp != '') {
                $lang = $tmp;
                return $lang;
            }
        }

        $files = File::files($dir);
        foreach ($files as $file) {
            $ext = pathinfo($file)['extension'];
            if (array_key_exists($ext, $this->langExtensions)) {
                $lang = $this->langExtensions[$ext];
                return $lang;
            }
        }

        return $lang;
    }



    public
    function tests()
    {

    }

    public function remove($code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();

        return view('assignments.delete', compact(['assignmentObj']));
    }


    public function destroy($code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();

        $assignmentObj->delete();

        return redirect(action('Assignments\AssignmentController@index'));
    }


}
