<?php
/*------------main---------------*/
function main()//主函数
{
	global $list;
	if (file_exists('cache_test.txt')) 	$list = output();
	$list = ageAddOne($list);
	$list = insertRandom($list);
	$list = delModule($list);
	foreach ($list as $key => $value) {
		echo "<br/>";
		echo $key.'===>'.$value['id'].'===>'.$value['age'].'===>'.$value['item'];
	}
	input($list);
}



/*--------------start------------------*/
function input($data)//数据存入文件
{	
	$data = serialize($data);
	$myfile = fopen("cache_test.txt","w") or die("无法创建或打开文件");
	$res = fwrite($myfile, $data);
	fclose($myfile);
	return $res;
}
function output()//输出文件内容
{
	$myfile = fopen("cache_test.txt", "r") or die("无法打开文件");
	$data = unserialize(fread($myfile,filesize("cache_test.txt")));
	fclose($myfile);
	return $data;
}
function insertRandom($list)//模拟随机插入
{
	$index = rand(0,count($list));
	$increment = getRandomID($list);
	if ($index == count($list)) {
		$value = array(
		array(
				'id'=>$increment,
				'age'=>1,
				'item' => null
			)
		);
	}else{
		$value = array(
		array(
				'id'=>getRandomID($list),
				'age'=>1,
				'item' => $list[$index]['id']
			)
		);
	}
	if ($index) $list[$index-1]['item'] = $increment;
	
    array_splice($list, $index, 0, $value);

    return $list;
}
function getRandomID($list)//模拟id自增长
{
	foreach ($list as $key => $value) {
		$arr[] = $value['id'];
	}

	return max($arr)+1;
}

function delModule($list)//淘汰操作
{	
	$tmp = 0;
	foreach ($list as $key => $value) {
		if ($value['age']>10) {
			if ($key) $list[$key-1]['item'] = $list[$key+1]['id'];
			unset($list[$key]);
			$tmp = 1;
			break;
		}
	}
	if ((!$tmp)&&(count($list)>=100)) unset($list[0]);

	return array_merge($list);

}
function ageAddOne($list)//加一操作
{
	foreach ($list as $key => $value) {
		$list[$key]['age'] += 1; 
	}

	return $list;

}
/*------prepare----------*/
$list= array(array('id' => 0,'age' => 1,'item' => 1),array('id' => 1,'age' => 1,'item' => 2),array('id' => 2,'age' => 1,'item' => 3),array('id' => 3,'age' => 1,'item' => 4),array('id' => 4,'age' => 1,'item' => 5),array('id' => 5,'age' => 1,'item' => 6),array('id' => 6,'age' => 1,'item' => 7),array('id' => 7,'age' => 1,'item' => 8),array('id' => 8,'age' => 1,'item' => 9),array('id' => 9,'age' => 1,'item' => 10),array('id' => 10,'age' => 1,'item' => 11),array('id' => 11,'age' => 1,'item' => 12),array('id' => 12,'age' => 1,'item' => 13),array('id' => 13,'age' => 1,'item' => 14),array('id' => 14,'age' => 1,'item' => 15),array('id' => 15,'age' => 1,'item' => 16),array('id' => 16,'age' => 1,'item' => 17),array('id' => 17,'age' => 1,'item' => 18),array('id' => 18,'age' => 1,'item' => 19),array('id' => 19,'age' => 1,'item' => 20),array('id' => 20,'age' => 1,'item' => 21),array('id' => 21,'age' => 1,'item' => 22),array('id' => 22,'age' => 1,'item' => 23),array('id' => 23,'age' => 1,'item' => 24),array('id' => 24,'age' => 1,'item' => 25),array('id' => 25,'age' => 1,'item' => 26),array('id' => 26,'age' => 1,'item' => 27),array('id' => 27,'age' => 1,'item' => 28),array('id' => 28,'age' => 1,'item' => 29),array('id' => 29,'age' => 1,'item' => 30),array('id' => 30,'age' => 1,'item' => 31),array('id' => 31,'age' => 1,'item' => 32),array('id' => 32,'age' => 1,'item' => 33),array('id' => 33,'age' => 1,'item' => 34),array('id' => 34,'age' => 1,'item' => 35),array('id' => 35,'age' => 1,'item' => 36),array('id' => 36,'age' => 1,'item' => 37),array('id' => 37,'age' => 1,'item' => 38),array('id' => 38,'age' => 1,'item' => 39),array('id' => 39,'age' => 1,'item' => 40),array('id' => 40,'age' => 1,'item' => 41),array('id' => 41,'age' => 1,'item' => 42),array('id' => 42,'age' => 1,'item' => 43),array('id' => 43,'age' => 1,'item' => 44),array('id' => 44,'age' => 1,'item' => 45),array('id' => 45,'age' => 1,'item' => 46),array('id' => 46,'age' => 1,'item' => 47),array('id' => 47,'age' => 1,'item' => 48),array('id' => 48,'age' => 1,'item' => 49),array('id' => 49,'age' => 1,'item' => 50),array('id' => 50,'age' => 1,'item' => null));
//header('Content-type:text/html;charset=utf-8');
main();

?>