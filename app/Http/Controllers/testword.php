<?php
/**
 * Created by PhpStorm.
 * User: nhluqun
 * Date: 2018/5/9
 * Time: 9:43
 */
//直接下载
$download = false;

//依赖扩展
$requirements = [
    'php' => ['PHP 5.3.3', version_compare(PHP_VERSION, '5.3.3', '>=')],
    'xml' => ['PHP extension XML', extension_loaded('xml')],
    'zip' => ['PHP extension ZipArchive (optional)', extension_loaded('zip')],
    'gd' => ['PHP extension GD (optional)', extension_loaded('gd')],
    'xmlw' => ['PHP extension XMLWriter (optional)', extension_loaded('xmlwriter')],
    'xsl' => ['PHP extension XSL (optional)', extension_loaded('xsl')],
];
foreach ($requirements as $key => $value) {
    list($label, $result) = $value;
    if ($result) {
        echo $download == false ?  "<p>{$label} ... Yes</p>" : '';
    } else {
        echo $download == false ?  "<p>{$label} ... <font color='red'>No</font></p>" : '';
    }
}

$phpWord = new \PhpOffice\PhpWord\PhpWord();
//添加页面
$section = $phpWord->addSection();

//添加目录
$styleTOC  = ['tabLeader' => \PHPWord_Style_TOC::TABLEADER_DOT];
$styleFont = ['spaceAfter' => 60, 'name' => 'Tahoma', 'size' => 12];
$section->addTOC($styleFont, $styleTOC);

//设置默认样式
$phpWord->setDefaultFontName('仿宋');//字体
$phpWord->setDefaultFontSize(16);//字号

//默认样式
$section->addText('aaaa第一行文字第一行文字第一行文字第一行文字aaaa');
$section->addTextBreak();//换行符

//指定的样式
$section->addText(
    'Hello world! 第二行文字第二行文字第二行文字.',
    [
        'name' => '宋体',
        'size' => 16,
        'bold' => true,
    ]
);
$section->addTextBreak(5);//多个换行符

//自定义样式
$myStyle = 'myStyle';
$phpWord->addFontStyle(
    $myStyle,
    [
        'name' => 'Verdana',
        'size' => 12,
        'color' => '1BFF32',
        'bold' => true,
        'spaceAfter' => 500,
    ]
);
$section->addText('第三行文字第三行文字', $myStyle);
$section->addText('第四行文字', $myStyle);
$section->addPageBreak();//分页符

//添加文本资源
$textrun = $section->addTextRun();
$textrun->addText('I am bold', ['bold' => true]);
$textrun->addText('I am italic', ['italic' => true]);
$textrun->addText('I am colored', ['color' => 'AACC00']);

//列表
$listStyle = ['listType' => \PHPWord_Style_ListItem::TYPE_NUMBER];
$section->addListItem('河北省', 0, null, $listStyle);
$section->addListItem('石家庄', 1, null, $listStyle);
$section->addListItem('邯郸', 1, null, $listStyle);
$section->addListItem('魏县', 2, null, $listStyle);
$section->addListItem('河南省', 0, null, $listStyle);
$section->addListItem('郑州', 1, null, $listStyle);
$section->addListItem('信阳', 1, null, $listStyle);

//超级链接
$linkStyle = ['color' => '0000FF', 'underline' => \PHPWord_Style_Font::UNDERLINE_SINGLE];
$phpWord->addLinkStyle('mylinkStyle', $linkStyle);
$section->addLink('http://www.baidu.com', '百度', 'mylinkStyle');
$section->addLink('http://www.lanrenkaifa.com', null, 'mylinkStyle');

//添加图片
$imageStyle = ['width' => 350, 'height' => 350, 'align' => 'center'];
$section->addImage(public_path().'/fen.png', $imageStyle);
$section->addImage(public_path().'/test.jpg');
//$section->addMemoryImage('http://localhost/image.php');//添加GD生成图片

//添加对象，支持后缀：'xls', 'doc', 'ppt'
//$section->addObject(public_path().'/demo.xls', ['align' => 'center']);

//添加标题,支持1-9标题
$phpWord->addTitleStyle(1, ['bold' => true, 'color' => '1BFF32', 'size' => 38, 'name' => 'Verdana']);
$section->addTitle('我是标题', 1);
$section->addTitle('我是标题2', 1);
$section->addTitle('我是标题3', 1);

//添加表格
$styleTable = [
    'borderColor' => '006699',
    'borderSize' => 6,
    'cellMargin' => 50,
];
$styleFirstRow = ['bgColor' => '66BBFF'];//第一行样式
$phpWord->addTableStyle('myTable', $styleTable, $styleFirstRow);

$table = $section->addTable('myTable');
$table->addRow(400);//行高400
$table->addCell(2000)->addText('名称');
$table->addCell(2000)->addText('价格');
$table->addCell(2000)->addText('数量');
$table->addRow(400);//行高400
$table->addCell(2000)->addText('小米手机');
$table->addCell(2000)->addText('3999元');
$table->addCell(2000)->addText('50');
$table->addRow(400);//行高400
$table->addCell(2000)->addText('苹果手机');
$table->addCell(2000)->addText('5999元');
$table->addCell(2000)->addText('10');

//页眉与页脚
$header = $section->addHeader();
$footer = $section->addFooter();
$header->addPreserveText('LanRenKaiFa.com');
$footer->addPreserveText('学会偷懒，并懒出效率。 - LanRenKaiFa.com Page {PAGE} of {NUMPAGES}.');

// Set writers
$writers = [
    'Word2007' => 'docx',
];
if ($download == false) {
    $writers['ODText'] = 'odt';
    $writers['RTF']    = 'rtf';
    $writers['HTML']   = 'html';
    $writers['PDF']    = null;// 不生成pdf了，因为没试成功
}
$result = '';
foreach ($writers as $writer => $extension) {
    if ($extension == null) {
        $result .= '<p>'.date('H:i:s')." Write to {$writer} format   <font color='red'>fail</font></p>";
    } else {
        $result .= '<p>'.date('H:i:s')." Write to {$writer} format</p>";
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, $writer);
        //是否下载
        if ($download === true) {
            $mime = [
                'Word2007' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'ODText' => 'application/vnd.oasis.opendocument.text',
                'RTF' => 'application/rtf',
                'HTML' => 'text/html',
                'PDF' => 'application/pdf',
            ];
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename="hello.'.$extension.'"');
            header('Content-Type: '.$mime[$writer]);
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Expires: 0');
            $filename = 'php://output'; // Change filename to force download
            $xmlWriter->save($filename);
        } else {
            $xmlWriter->save("hello.{$extension}");
        }
    }
}
if (!$download) {
    return $result;
}