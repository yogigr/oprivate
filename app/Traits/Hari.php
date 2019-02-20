<?php

namespace App\Traits;

use Carbon\Carbon;

trait Hari
{
	public function getHariIni($dayName)
	{
		switch ($dayName) {
			case 'Mon':
				return 'Senin';
				break;
			case 'Tue':
				return 'Selasa';
				break;
			case 'Wed':
				return 'Rabu';
				break;
			case 'Thu':
				return 'Kamis';
				break;
			case 'Fri':
				return 'Jumat';
				break;
			case 'Sat':
				return 'Sabtu';
				break;
			case 'Sun':
				return 'Minggu';
				break;
			default:
				return false;
				break;
		}
	}
}