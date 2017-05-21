<?php
namespace braga\daogenerator\generator;
/**
 * Created on 23-03-2013 14:29:33
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class ClassFileGenerator extends DAOFileGenerator
{
	// -------------------------------------------------------------------------
	protected $file = null;
	// -------------------------------------------------------------------------
	public function GO()
	{
		foreach($this->project->getTables() as $t)/* @var $t Table */
		{
			@mkdir($this->project->getProjectFolder() . "/" . $this->project->getObjFolder(), 0777, true);
			$this->file = $this->project->getProjectFolder() . $this->project->getObjFolder() . "/" . $t->getClassName() . ".php";
			if(!file_exists($this->file))
			{
				$this->open($t);
				$this->generateNameSpace($t);
				$this->prepareClass($t);
				$this->close();
			}
		}
	}
	// -------------------------------------------------------------------------
	protected function generateNameSpace(Table $t)
	{
		if(strlen($this->project->getNameSpace()) > 0)
		{
			$this->addLine("namespace " . $this->project->getNameSpace() . "obj;", 0);
			$this->addLine("use braga\db\BusinesObject;", 0);
			$this->addLine("use braga\db\Collection;", 0);
			$this->addLine("use " . $this->project->getNameSpace() . $this->project->getDaoFolder() . "\\" . $t->getClassName() . "DAO;", 0);
			if($this->project->getDataBaseStyle() == DataBaseStyle::PGSQL)
			{
				$this->addLine("use braga\db\pgsql\DB;", 0);
			}
			elseif($this->project->getDataBaseStyle() == DataBaseStyle::ORACLE)
			{
				$this->addLine("use braga\db\oracle\DB;", 0);
			}
			else
			{
				$this->addLine("use braga\db\mysql\DB;", 0);
			}
		}
	}
	// -------------------------------------------------------------------------
	protected function prepareClass(Table $t)
	{
		$this->generateClassDocumentation($t);
		$this->generateClassHead($t);
		$this->generateCheck($t);
		$this->generateSave($t);
		$this->generateKill($t);
		$this->generateGetAllExample($t);
		$this->generateClassFooter();
	}
	// -------------------------------------------------------------------------
	protected function generateCheck($t)
	{
		$this->addLine("/**", 1);
		$this->addLine(" * Methods validate data before save", 1);
		$this->addLine(" * @return boolean", 1);
		$this->addLine(" */", 1);
		$this->addLine("protected function check()", 1);
		$this->addLine("{", 1);
		$this->addLine("// TODO: add special validate ", 2);
		$this->addLine("return true;", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateGetAllExample($t)
	{
		$this->addLine("/**", 1);
		$this->addLine(" * This method returns a collection of objects ", 1);
		$this->addLine(" * @return Collection &lt;" . $t->getClassName() . "&gt; ", 1);
		$this->addLine(" */", 1);
		$this->addLine("public static function getAll()", 1);
		$this->addLine("{", 1);
		$this->addLine("// TODO: this is example of method selecting multi rec from table ", 2);
		$this->addLine("\$db = new DB();", 2);
		$this->addLine("\$sql  = \"SELECT * \";", 2);
		$this->addLine("\$sql .= \"FROM \" . " . $t->getSchema() . " . \"." . $t->getName() . " \";", 2);
		$this->addLine("\$db->query(\$sql);", 2);
		$this->addLine("return new Collection(\$db, self::get());", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateKill($t)
	{
		$this->addLine("/**", 1);
		$this->addLine(" * Method removes an object of class " . $t->getClassName(), 1);
		$this->addLine(" * @return boolean", 1);
		$this->addLine(" */", 1);
		$this->addLine("public function kill()", 1);
		$this->addLine("{", 1);
		$this->addLine("// TODO: this method may be changed when record can not be deleted from table", 2);
		$this->addLine("return \$this->destroy();", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateSave($t)
	{
		$this->addLine("/**", 1);
		$this->addLine(" * Method saves the object of the class " . $t->getClassName(), 1);
		$this->addLine(" * @return boolean", 1);
		$this->addLine(" */", 1);
		$this->addLine("public function save()", 1);
		$this->addLine("{", 1);
		$this->addLine("// TODO: please set atrib independens of clients ex lastupdate", 2);
		$this->addLine("if(\$this->check())", 2);
		$this->addLine("{", 2);
		$this->addLine("if(\$this->isReaded())", 3);
		$this->addLine("{", 3);
		$this->addLine("return \$this->update();", 4);
		$this->addLine("}", 3);
		$this->addLine("else", 3);
		$this->addLine("{", 3);
		$this->addLine("return \$this->create();", 4);
		$this->addLine("}", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("return false;", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateClassHead($t)
	{
		$this->addLine("class " . $t->getClassName() . " extends " . $t->getClassName() . "DAO implements BusinesObject", 0);
		$this->addLine("{", 0);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateClassDocumentation(Table $t)
	{
		$this->addLine("/**", 0);
		$this->addLine(" * Created on " . date("d-m-Y H:i:s"), 0);
		$this->addLine(" * @author " . $this->project->getAuthor(), 0);
		$this->addLine(" * @package " . $this->project->getName(), 0);
		$this->addLine(" * error prefix " . $t->getErrorPrefix(), 0);
		$this->addLine(" * Generated by SimplePHPDAOClassGenerator ver " . Project::VERSION, 0);
		$this->addLine(" * https://sourceforge.net/projects/simplephpdaogen/ ", 0);
		$this->addLine(" * {please complete documentation}", 0);
		$this->addLine(" */", 0);
	}
	// -------------------------------------------------------------------------
	protected function open(Table $t)
	{
		$this->fileHandle = fopen($this->file, "w");
		$this->addLine("<?php", 0);
	}
	// -------------------------------------------------------------------------
}
?>