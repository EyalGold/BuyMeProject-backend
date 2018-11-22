<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksController extends TestCase
{
    use DatabaseMigrations;
   
    public function testIndex()
    {
        $tasks = factory(\App\Task::class, 2)->create();
        $response = $this
            ->get(route('tasks.index'))->seeStatusCode(200)->response;
        $content = json_decode($response->getContent());
        $this->objectHasAttribute('tasks', $content);
        $this->assertCount(2, $content->tasks);
        foreach($tasks as $task) {
            $this->assertNotNull($task->body);
            $this->assertNotNull($task->done);
        }
    }

    public function testUpdate()
    {
        factory(\App\Task::class, 2)->create();
        $task1 = \App\Task::find(1);

        $request = $this->put('/tasks/'. $task1->id, [
            'task' => [
                'id'   => $task1->id,
                'body' => 'test1',
                'done' => !$task1->done
            ]
        ]);
        $request->assertResponseStatus(200);
        $response = $request->response;
        $content = json_decode($response->getContent());
        $this->assertEquals($task1->done, !$content->done);
        $this->assertEquals('test1', $content->body);
    }

    public function testDelete()
    {
        factory(\App\Task::class, 2)->create();
        $task1 = \App\Task::find(1);
        $request = $this->delete('/tasks/'.$task1->id);
        $request->assertResponseStatus(204);
        $this->assertNull(\App\Task::find(1));
    }

    public function testStore()
    {
        $request = $this->post('/tasks', [
            'task' => [
                'body' => 'test1',
                'done' => false
            ]
        ]);
        $request->assertResponseStatus(201);
        $response = $request->response;
        $content = json_decode($response);

    }
}
