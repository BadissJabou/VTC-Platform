<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_contact_page()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Contactez-nous');
        $response->assertSee('Envoyez-nous un message');
    }

    /** @test */
    public function it_can_submit_contact_form()
    {
        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+33612345678',
            'subject' => 'info',
            'message' => 'Ceci est un message de test.',
            'privacy' => 'on',
        ];

        $response = $this->post('/contact', $contactData);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }

    /** @test */
    public function it_validates_required_contact_fields()
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'phone',
            'subject',
            'message',
            'privacy',
        ]);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'phone' => '+33612345678',
            'subject' => 'info',
            'message' => 'Test message',
            'privacy' => 'on',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_subject_is_valid_option()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+33612345678',
            'subject' => 'invalid_subject',
            'message' => 'Test message',
            'privacy' => 'on',
        ]);

        $response->assertSessionHasErrors(['subject']);
    }

    /** @test */
    public function it_validates_message_length()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+33612345678',
            'subject' => 'info',
            'message' => str_repeat('a', 2001), // 2001 characters, over the limit
            'privacy' => 'on',
        ]);

        $response->assertSessionHasErrors(['message']);
    }

    /** @test */
    public function it_shows_success_message_after_submission()
    {
        $contactData = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '+33687654321',
            'subject' => 'reservation',
            'message' => 'Je souhaite réserver un service.',
            'privacy' => 'on',
        ];

        $response = $this->post('/contact', $contactData);

        $response->assertRedirect('/contact');
        
        // Follow the redirect to check for success message
        $response = $this->get('/contact');
        $response->assertSee('Votre message a été envoyé avec succès !');
    }
}
