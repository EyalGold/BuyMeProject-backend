<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Task extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function testTaskCreation()
    {
        $task = \App\Task::create([
            'body' => 'test',
            'done' => true
        ]);
        $dbTask = \App\Task::find(1);
        $this->assertEquals('test', $dbTask->body, 'Body is "test"');
        $this->assertEquals(1, $dbTask->done, 'Task set as done');
        $this->seeInDatabase('tasks', $task->attributesToArray());
    }

    /**
     * @test
     */
    public function testTaskDeletion()
    {
        $task = \App\Task::create([
            'body' => 'test',
            'done' => true
        ]);
        $taskAttributes = $task->attributesToArray();
        $this->seeInDatabase('tasks', $taskAttributes);
        $task->delete();
        $this->notSeeInDatabase('tasks', $taskAttributes);
    }
}
