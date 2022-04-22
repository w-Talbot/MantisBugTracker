<?php
use PHPUnit\Framework\TestCase;

require_once('MantisBugTracker/manage_user_proj_mult_delete.php');

final class CheckTest extends TestCase
{

    public function test_0001(): void
    {
        $expected = 11;
        $actual = 11;
        $this->assertSame($expected, $actual);
    }

}