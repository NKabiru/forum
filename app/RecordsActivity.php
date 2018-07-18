<?php
/**
 * Created by PhpStorm.
 * User: kabiru
 * Date: 18/07/18
 * Time: 13:02
 */

namespace App;


trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;

       foreach (static::getActivitiesToRecord() as $event){
           static::$event(function ($model) use ($event) {
               $model->recordActivity($event);
           });
       }
    }

    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }

    protected function recordActivity($event): void
    {
        $this->activity()->create([
            'type' => $this->getActivityType($event),
            'user_id' => auth()->id(),
        ]);

    }

    protected function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityType($event)
    {
        $type = strtolower(class_basename($this));

        return "{$event}_{$type}";
    }
}