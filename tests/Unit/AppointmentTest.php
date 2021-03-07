<?php

namespace Tests;
use App\Models\Appointment;

use PHPUnit\Framework\TestCase;


class AppointmentTest extends TestCase
{

	public function test_can_create_Appointment()
	{
		$id = uniqid();
        $appointment = new Appointment($id, "Vanessa", "How to upload files");
        $this->assertEquals($id, $appointment->id);
        $this->assertEquals("Vanessa", $appointment->student);
        $this->assertEquals("How to upload files", $appointment->subject);
	}
}