<?php
namespace braga\tools\tools;
/**
 * Created on 25.12.2016 14:26:14
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class UploadFileManager
{
	// -------------------------------------------------------------------------
	protected $size;
	protected $mimeType;
	protected $temporaryFilename;
	protected $orginalFilename;
	protected $content;
	// -------------------------------------------------------------------------
	/**
	 *
	 * @param string $postName
	 * @throws \Exception
	 * @return \braga\tools\tools\UploadFileManager
	 */
	public static function getFileContent($postName)
	{
		$retval = new self();
		if(isset($_FILES[$postName]))
		{
			if($_FILES[$postName]["error"] == UPLOAD_ERR_OK)
			{
				$tempFileName = $_FILES[$postName]["tmp_name"];
				$retval->setTemporaryFilename($tempFileName);
				if(is_uploaded_file($tempFileName))
				{
					$retval->setSize($_FILES[$postName]["size"]);
					$retval->setOrginalFilename($_FILES[$postName]["name"]);
					$retval->setMimeType($_FILES[$postName]["type"]);
					$retval->setContent(file_get_contents($tempFileName));
					return $retval;
				}
				else
				{
					throw new \Exception("BT:10001 File not uploaded", 10001);
				}
			}
			else
			{
				throw new \Exception("BT:10002 Transmision error: " . $_FILES[$postName]["error"], 10002);
			}
		}
		else
		{
			throw new \Exception("BT:10003 File not transmited", 10003);
		}
	}
	// -------------------------------------------------------------------------
	public function getSize()
	{
		return $this->size;
	}
	// -------------------------------------------------------------------------
	public function setSize($size)
	{
		$this->size = $size;
	}
	// -------------------------------------------------------------------------
	public function getMimeType()
	{
		return $this->mimeType;
	}
	// -------------------------------------------------------------------------
	public function setMimeType($mimeType)
	{
		$this->mimeType = $mimeType;
	}
	// -------------------------------------------------------------------------
	public function getTemporaryFilename()
	{
		return $this->temporaryFilename;
	}
	// -------------------------------------------------------------------------
	public function setTemporaryFilename($temporaryFilename)
	{
		$this->temporaryFilename = $temporaryFilename;
	}
	// -------------------------------------------------------------------------
	public function getOrginalFilename()
	{
		return $this->orginalFilename;
	}
	// -------------------------------------------------------------------------
	public function setOrginalFilename($orginalFilename)
	{
		$this->orginalFilename = $orginalFilename;
	}
	// -------------------------------------------------------------------------
	public function getContent()
	{
		return $this->content;
	}
	// -------------------------------------------------------------------------
	public function setContent($content)
	{
		$this->content = $content;
	}
	// -------------------------------------------------------------------------
}