<?php
use braga\widgets\jqueryui\DBGrid;
use braga\db\ArrayToDBBridge;
use braga\widgets\jqueryui\DBGridColumn;
use braga\widgets\jqueryui\DBGridReplacer;

/**
 * Created on 11.11.2016 21:25:22
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQDBGridTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function getData3()
	{
		$b1 = new BusinesObject();
		$b1->setId(1);
		$b1->setName("StrangeName1");
		$b1->setDesc("StrangeDesc1");
		$b2 = new BusinesObject();
		$b2->setId(2);
		$b2->setName("StrangeName2");
		$b2->setDesc("StrangeDesc2");
		$b3 = new BusinesObject();
		$b3->setId(3);
		$b3->setName("StrangeName3");
		$b3->setDesc("StrangeDesc3");

		$array = array();
		$array[] = $b1;
		$array[] = $b2;
		$array[] = $b3;
		$db = new ArrayToDBBridge($array);
		$db->addTranslate("getId", 0, "Id", "int");
		$db->addTranslate("getName", 1, "Name");
		$db->addTranslate("getDesc", 2, "Desc");
		return $db;

	}
	// -------------------------------------------------------------------------
	function getData1()
	{
		$b1 = new BusinesObject();
		$b1->setId(1);
		$b1->setName("StrangeName1");
		$b1->setDesc("StrangeDesc1");

		$array = array();
		$array[] = $b1;
		$db = new ArrayToDBBridge($array);
		$db->addTranslate("getId", 0, "Id", "int");
		return $db;

	}
	// -------------------------------------------------------------------------
	function testTreeOnTree()
	{
		$g = new DBGrid();
		$g->setDataSource($this->getData3());

		$actual = $g->out(true);

		$th = "<th class='' style='width:10px;'>L.p.</th>";
		$th .= "<th class=''>Id</th>";
		$th .= "<th class=''>Name</th>";
		$th .= "<th class=''>Desc</th>";
		$tr = "<tr class='ui-state-highlight'>" . $th . "</tr>";
		$thead = "<thead>" . $tr . "</thead>";

		$tr = "<tr class=' ui-state-default'><td class='r' style='padding-right:4px;'>1</td><td class='r'><div>1</div></td><td class='l'><div>StrangeName1</div></td><td class='l'><div>StrangeDesc1</div></td></tr>";
		$tr .= "<tr class=' ui-state-focus'><td class='r' style='padding-right:4px;'>2</td><td class='r'><div>2</div></td><td class='l'><div>StrangeName2</div></td><td class='l'><div>StrangeDesc2</div></td></tr>";
		$tr .= "<tr class=' ui-state-default'><td class='r' style='padding-right:4px;'>3</td><td class='r'><div>3</div></td><td class='l'><div>StrangeName3</div></td><td class='l'><div>StrangeDesc3</div></td></tr>";
		$tbody = "<tbody>" . $tr . "</tbody>";

		$expected = "<table class='sto ui-widget-content'>" . $thead . $tbody . "</table>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$g = new DBGrid();
		$g->setDataSource($this->getData1());
		$g->setHrefActionString("?a=");

		$actual = $g->out(true);

		$expected = "<table class='sto ui-widget-content'><thead><tr class='ui-state-highlight'><th class='' style='width:10px;'>L.p.</th><th class=''>Id</th></tr></thead><tbody><tr class=' ui-state-default'><td class='r' style='padding-right:4px;'>1</td><td class='r'><div><a href='?a=' onclick='return ajax.go(this);'>1</a></div></td></tr></tbody></table>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testSimpleAddColumn()
	{
		$g = new DBGrid();
		$g->setDataSource($this->getData1());
		$g->setHrefActionString("?a=");
		$col = new DBGridColumn("new", "Bubba");
		$g->addColumn($col);
		$actual = $g->out(true);

		$expected = "<table class='sto ui-widget-content'><thead><tr class='ui-state-highlight'><th class='' style='width:10px;'>L.p.</th><th class=''>Id</th><th class=''>new</th></tr></thead><tbody><tr class=' ui-state-default'><td class='r' style='padding-right:4px;'>1</td><td class='r'><div><a href='?a=' onclick='return ajax.go(this);'>1</a></div></td><td class='l'>Bubba</td></tr></tbody></table>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testReplacer()
	{
		$g = new DBGrid();
		$g->setDataSource($this->getData1());
		$g->setHrefActionString("?a=#@#_1_#@#");
		$r = new DBGridReplacer("#@#_1_#@#", 0);
		$g->addHrefReplaceStringByField($r);
		$actual = $g->out(true);

		$expected = "<table class='sto ui-widget-content'><thead><tr class='ui-state-highlight'><th class='' style='width:10px;'>L.p.</th><th class=''>Id</th></tr></thead><tbody><tr class=' ui-state-default'><td class='r' style='padding-right:4px;'>1</td><td class='r'><div><a href='?a=1' onclick='return ajax.go(this);'>1</a></div></td></tr></tbody></table>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
}
class BusinesObject
{
	protected $id;
	protected $name;
	protected $desc;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getDesc()
	{
		return $this->desc;
	}

	public function setDesc($desc)
	{
		$this->desc = $desc;
	}

}
?>