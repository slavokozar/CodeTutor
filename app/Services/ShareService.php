<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17.4.2018
 * Time: 20:50
 */

namespace App\Services;

use App\Models\Sharing;

use App\Notifications\newSharedArticleNotification;
use App\Notifications\newSharedAssignmentNotification;
use Facades\App\Services\Users\Schools\SchoolService;
use Facades\App\Services\Users\Groups\GroupService;

class ShareService
{
    public function setSharing($object, $share, $notifications = false)
    {
        if ($share == null)
            return;

        $schoolPrefix = 'school_';

        $schoolIds = [];
        $groupIds = [];


        foreach ($share as $shareId) {
            if (substr($shareId, 0, strlen($schoolPrefix)) === $schoolPrefix) {
                $schoolIds[] = str_replace($schoolPrefix, '', $shareId);
            } else {
                $groupIds[] = $shareId;
            }
        }

        $this->syncSharingInSchool($object, $schoolIds, $notifications);
        $this->syncSharingInGroup($object, $groupIds, $notifications);

    }

    public function syncSharingInSchool($object, $schoolIds, $notifications = false)
    {
        foreach ($object->sharingsSchools as $sharingObj) {
            if (!in_array($sharingObj->school_id, $schoolIds))
                $this->stopSharingInSchool($object, $sharingObj->school, $notifications);
        }

        foreach ($schoolIds as $schoolId) {
            if (!$object->sharingsSchools()->where('school_id', $schoolId)->exists()) {
                $schoolObj = SchoolService::findOrFail($schoolId);
                $this->startSharingInSchool($object, $schoolObj, $notifications);
            }
        }
    }


    public function startSharingInSchool($object, $schoolObj, $notifications = false)
    {
        Sharing::create([
            'school_id' => $schoolObj->id,
            'object_type' => $object->sharingType,
            'object_id' => $object->id,
        ]);

        if ($notifications) {
            //todo notification
        }
    }

    public function stopSharingInSchool($object, $schoolObj, $notifications = false)
    {
        $object->sharingsSchools()->where('object_id', $object->id)->delete();

        if ($notifications) {
            //todo notification
        }
    }


    public function syncSharingInGroup($object, $groupIds, $notifications = false)
    {
        foreach ($object->sharingsGroups as $sharingObj) {
            if (!in_array($sharingObj->group_id, $groupIds))
                $this->stopSharingInGroup($object, $sharingObj->group, $notifications);
        }

        foreach ($groupIds as $groupId) {
            if (!$object->sharingsGroups()->where('group_id', $groupId)->exists()) {
                $groupObj = GroupService::findOrFail($groupId);
                $this->startSharingInGroup($object, $groupObj, $notifications);
            }
        }
    }

    public function startSharingInGroup($object, $groupObj, $notifications = false)
    {
        Sharing::create([
            'group_id' => $groupObj->id,
            'object_type' => $object->sharingType,
            'object_id' => $object->id,
        ]);

        if ($notifications) {
            foreach($groupObj->users as $userObj){
                if($object->sharingType == 'article')
                    $userObj->notify(new newSharedArticleNotification($object));
                elseif($object->sharingType == 'assignment')
                    $userObj->notify(new newSharedAssignmentNotification($object));
            }
            //todo notification
        }
    }

    public function stopSharingInGroup($object, $groupObj, $notifications = false)
    {
        $object->sharingsGroups()->where('object_id', $object->id)->delete();

        if ($notifications) {
            //todo notification
        }
    }


}