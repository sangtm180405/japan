<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Vocabulary;
use App\Models\Grammar;
use App\Models\Exercise;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $lesson;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        
        $this->lesson = Lesson::create([
            'title' => 'Test Lesson',
            'description' => 'Test Description',
            'level' => 1,
            'order' => 1,
            'is_active' => true
        ]);
    }

    /** @test */
    public function authenticated_user_can_view_lessons()
    {
        $response = $this->actingAs($this->user)
                         ->get('/lessons');

        $response->assertStatus(200);
    }

    /** @test */
    public function unauthenticated_user_redirected_to_login()
    {
        $response = $this->get('/lessons');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_view_specific_lesson()
    {
        $response = $this->actingAs($this->user)
                         ->get("/lessons/{$this->lesson->id}");

        $response->assertStatus(200)
                ->assertSee($this->lesson->title);
    }

    /** @test */
    public function lesson_shows_vocabulary()
    {
        Vocabulary::create([
            'lesson_id' => $this->lesson->id,
            'japanese' => 'こんにちは',
            'hiragana' => 'こんにちは',
            'romaji' => 'konnichiwa',
            'vietnamese' => 'xin chào',
            'topic' => 'Chào hỏi',
            'is_active' => true
        ]);

        $response = $this->actingAs($this->user)
                         ->get("/lessons/{$this->lesson->id}");

        $response->assertStatus(200)
                ->assertSee('こんにちは')
                ->assertSee('konnichiwa')
                ->assertSee('xin chào');
    }

    /** @test */
    public function lesson_shows_grammar()
    {
        Grammar::create([
            'lesson_id' => $this->lesson->id,
            'title' => 'Test Grammar',
            'explanation' => 'Test explanation',
            'structure' => 'Test structure',
            'examples' => 'Test examples',
            'usage_notes' => 'Test notes',
            'difficulty_level' => 1
        ]);

        $response = $this->actingAs($this->user)
                         ->get("/lessons/{$this->lesson->id}");

        $response->assertStatus(200)
                ->assertSee('Test Grammar')
                ->assertSee('Test explanation');
    }

    /** @test */
    public function lesson_shows_exercises()
    {
        Exercise::create([
            'lesson_id' => $this->lesson->id,
            'type' => 'multiple_choice',
            'question' => 'Test question?',
            'options' => json_encode(['A', 'B', 'C', 'D']),
            'correct_answer' => 'A',
            'explanation' => 'Test explanation',
            'points' => 10,
            'difficulty_level' => 1
        ]);

        $response = $this->actingAs($this->user)
                         ->get("/lessons/{$this->lesson->id}");

        $response->assertStatus(200)
                ->assertSee('Test question?');
    }

    /** @test */
    public function user_can_start_lesson()
    {
        $response = $this->actingAs($this->user)
                         ->post("/lessons/{$this->lesson->id}/start");

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('user_progress', [
            'user_id' => $this->user->id,
            'lesson_id' => $this->lesson->id
        ]);
    }

    /** @test */
    public function user_can_complete_lesson()
    {
        $response = $this->actingAs($this->user)
                         ->post("/lessons/{$this->lesson->id}/complete", [
                             'score' => 100,
                             'total_questions' => 5,
                             'correct_answers' => 5
                         ]);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('user_progress', [
            'user_id' => $this->user->id,
            'lesson_id' => $this->lesson->id,
            'is_completed' => true,
            'score' => 100
        ]);
    }

    /** @test */
    public function lesson_404_for_nonexistent_lesson()
    {
        $response = $this->actingAs($this->user)
                         ->get('/lessons/99999');

        $response->assertStatus(404);
    }
}