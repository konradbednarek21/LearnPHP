<?php
namespace braga\tools\tools;

/**
 * Created on 2009-04-27 21:13:09
 */
class Slownie
{
	// -------------------------------------------------------------------------
	protected $liczby;
	protected $wielkosci;
	// -------------------------------------------------------------------------
	public static function get($liczba)
	{
		$t = new self();
		return $t->out($liczba);
	}
	// -------------------------------------------------------------------------
	private function __construct()
	{
		// $this->liczby[0] = "zero";
		$this->liczby[1] = "jeden";
		$this->liczby[2] = "dwa";
		$this->liczby[3] = "trzy";
		$this->liczby[4] = "cztery";
		$this->liczby[5] = "pięć";
		$this->liczby[6] = "sześć";
		$this->liczby[7] = "siedem";
		$this->liczby[8] = "osiem";
		$this->liczby[9] = "dziewięć";
		$this->liczby[10] = "dziesięć";
		$this->liczby[11] = "jedenaście";
		$this->liczby[12] = "dwanaście";
		$this->liczby[13] = "trzynaście";
		$this->liczby[14] = "czternaście";
		$this->liczby[15] = "pietnaście";
		$this->liczby[16] = "szesnaście";
		$this->liczby[17] = "siedemnaście";
		$this->liczby[18] = "osiemnaście";
		$this->liczby[19] = "dziewiętnaście";
		$this->liczby[20] = "dwadzieścia";
		$this->liczby[30] = "trzydzieści";
		$this->liczby[40] = "czterdzieści";
		$this->liczby[50] = "pięćdziesiąt";
		$this->liczby[60] = "sześćdziesiąt";
		$this->liczby[70] = "siedemdziesiąt";
		$this->liczby[80] = "osiemdziesiąt";
		$this->liczby[90] = "dziewięćdziesiąt";
		$this->liczby[100] = "sto";
		$this->liczby[200] = "dwieście";
		$this->liczby[300] = "trzysta";
		$this->liczby[400] = "czterysta";
		$this->liczby[500] = "pięćset";
		$this->liczby[600] = "sześćset";
		$this->liczby[700] = "siedemset";
		$this->liczby[800] = "osiemset";
		$this->liczby[900] = "dziewięćset";
	}
	// -------------------------------------------------------------------------
	protected function out($liczba)
	{
		$LiczbaOrg = $liczba;
		$retval = "";
		if($liczba > pow(10, 12))
		{
			return "zbyt wielka liczba";
		}
		// miliardy ==========================================================
		$ilosc = intval($liczba / pow(10, 9));
		$retval .= $this->subSlownie($ilosc);
		$jedn = $ilosc % 10;
		$tmp = $ilosc % 100;
		if($ilosc == 0)
		{
			$retval .= "";
		}
		elseif($ilosc == 1)
		{
			$retval .= " miliard";
		}
		elseif(($jedn > 1 and $jedn < 5 and $tmp > 19) or ($ilosc > 1 and $ilosc < 5))
		{
			$retval .= " miliardy";
		}
		else
		{
			$retval .= " miliardów";
		}
		// =================================================================
		$liczba -= $ilosc * pow(10, 9);
		$retval .= " ";

		// miliony ==========================================================
		$ilosc = intval($liczba / pow(10, 6));
		$retval .= $this->subSlownie($ilosc);
		$jedn = $ilosc % 10;
		$tmp = $ilosc % 100;
		if($ilosc == 0)
		{
			$retval .= "";
		}
		elseif($ilosc == 1)
		{
			$retval .= " milion";
		}
		elseif(($jedn > 1 and $jedn < 5 and $tmp > 19) or ($ilosc > 1 and $ilosc < 5))
		{
			$retval .= " miliony";
		}
		else
		{
			$retval .= " milionów";
		}
		// =================================================================
		$liczba -= $ilosc * pow(10, 6);
		$retval .= " ";

		// tysiące ==========================================================
		$ilosc = intval($liczba / pow(10, 3));
		$retval .= $this->subSlownie($ilosc);
		$jedn = $ilosc % 10;
		$tmp = $ilosc % 100;
		if($ilosc == 0)
		{
			$retval .= "";
		}
		elseif($ilosc == 1)
		{
			$retval .= " tysiąc";
		}
		elseif(($jedn > 1 and $jedn < 5 and $tmp > 19) or ($ilosc > 1 and $ilosc < 5))
		{
			$retval .= " tysiące";
		}
		else
		{
			$retval .= " tysięcy";
		}
		// =================================================================
		$liczba -= $ilosc * pow(10, 3);
		$retval .= " ";

		// jedności ==========================================================
		$ilosc = intval($liczba);
		$retval .= $this->subSlownie($ilosc);
		$jedn = $ilosc % 10;
		$dzies = $ilosc % 100;
		if(trim($retval) == "")
		{
			$retval .= " zero złotych";
		}
		elseif($dzies > 10 and $dzies < 20)
		{
			$retval .= " złotych";
		}
		elseif($jedn > 1 and $jedn < 5)
		{
			$retval .= " złote";
		}
		elseif($jedn > 0 and $jedn < 2 and $LiczbaOrg < 10)
		{
			$retval .= " złoty";
		}
		else
		{
			$retval .= " złotych";
		}

		$liczba -= $ilosc;

		$liczba = round($liczba * 100);

		$retval .= " i";
		// grosze ==========================================================
		$ilosc = intval($liczba);
		$retval .= $this->subSlownie($ilosc);
		$jedn = $ilosc % 10;
		if($ilosc == 0)
		{
			$retval .= " zero groszy";
		}
		elseif($ilosc == 1)
		{
			$retval .= " grosz";
		}
		elseif($jedn > 1 and $jedn < 5)
		{
			$retval .= " grosze";
		}
		else
		{
			$retval .= " groszy";
		}

		return trim($retval);
	}
	// -------------------------------------------------------------------------
	protected function subSlownie($liczba)
	{
		$retval = "";
		$setki = intval($liczba / 100) * 100;
		$liczba -= $setki;
		$dziesiatki = intval($liczba / 10) * 10;

		if($setki > 0)
		{
			$retval = $this->liczby[$setki];
		}
		if($dziesiatki > 19)
		{
			$retval .= " " . $this->liczby[$dziesiatki];
			$liczba -= $dziesiatki;
		}
		if($liczba > 0)
		{
			$retval .= " " . $this->liczby[$liczba];
		}

		return $retval;
	}
	// -------------------------------------------------------------------------
}

?>
