<?php
namespace braga\tools\tools;
/**
 * Created on 30-05-2011 16:33:52
 * @author Tomasz.Gajewski
 * @package error prefix EN:128
 */
class SendedFile
{
	// -------------------------------------------------------------------------
	/**
	 * metoda służąca do wysyłania plików
	 * metoda pakuje plik oraz wysyła
	 */
	static function sendFile($filename, $contentFileName)
	{
		$zip = new ZipArchive();
		$tmpFileName = TEMP_PATH . RandomStringLetterOnly(50);
		if($zip->open($tmpFileName, ZipArchive::CREATE) === true)
		{
			$zip->addFile($contentFileName, $filename);
			$zip->close();
			self::sendHeader($filename . ".zip");
			@readfile($tmpFileName);
			@unlink($tmpFileName);
			@unlink($contentFileName);
			exit();
		}
		else
		{
			AddAlert("EN:12801 Błąd tworzenia pliku ZIP");
			echo "?action=Null";
			exit();
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * metoda służąca do wysyłania plików
	 * metoda pakuje plik oraz wysyła
	 */
	static function send($filename, $content)
	{
		$zip = new ZipArchive();
		$tmpContentFileName = TEMP_PATH . RandomStringLetterOnly(50);
		if(@file_put_contents($tmpContentFileName, $content) !== false)
		{
			self::sendFile($filename, $tmpContentFileName);
		}
		else
		{
			AddAlert("EN:12802 Błąd zapisu plik treści");
			echo "?action=Null";
			exit();
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * metoda wysyła plik z określoną nazwą i zawartością
	 * bez kompresji
	 */
	static function sendNoZip($filename, $content)
	{
		self::sendHeader($filename);
		echo $content;
		exit();
	}
	// -------------------------------------------------------------------------
	/**
	 * metoda wysyła nagłówki niezbędne do pobrania pliku
	 */
	static function sendHeader($filename)
	{
		header("Expires:" . date("D, d M Y H:i:s") . "");
		header("Cache-Control: no-transform; max-age=0; proxy-revalidate; no-cache; must-revalidate; no-store; post-check=0; pre-check=0");
		header("Pragma: public");
		header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
		header("Content-type: application/x-download");
	}
	// -------------------------------------------------------------------------
}
?>