<?php
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;

/* Do NOT delete this comment */
/* 不要删除这段注释 */


$configs = array(
    'name' => '糗事百科',
    'log_show' => true,
    'log_type' => 'info',
    'tasknum' => 1,
    'max_depth' => 1,//采集知乎好友时只采集深度
    'max_fields' => 100,//爬虫爬取内容网页最大条数
    'user_agent' => array(//随机浏览器类型，用于破解防采集
	    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
	    "Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13G34 Safari/601.1",
	    "Mozilla/5.0 (Linux; U; Android 6.0.1;zh_cn; Le X820 Build/FEXCNFN5801507014S) AppleWebKit/537.36 (KHTML, like Gecko)Version/4.0 Chrome/49.0.0.0 Mobile Safari/537.36 EUI Browser/5.8.015S",
	),
	'export' => array(
	    'type' => 'csv', 
	    'file' => './data/test.csv', // data目录下
	),
    'domains' => array(
        'qiushibaike.com',
        'www.qiushibaike.com'
    ),
    'scan_urls' => array(
        'https://www.qiushibaike.com/hot/'
    ),
    'content_url_regexes' => array(
        "http://www.qiushibaike.com/article/\d+"
    ),
    'list_url_regexes' => array(
        "http://www.qiushibaike.com/8hr/page/\d+\?s=\d+"
    ),
    //定义内容页的抽取规则
    'fields' => array(
        array(
            // 抽取内容页的文章内容
            'name' => "article_content",
            'selector' => "//*[@id='single-next-link']",
            'required' => true
        ),
    ),
);
$spider = new phpspider($configs);

$spider->on_start = function($phpspider) 
{
	$ips = array(
        "192.168.0.2",
        "192.168.0.3",
        "192.168.0.4"
    );
    requests::set_client_ip($ips);
    
    requests::set_header('Referer','http://www.mafengwo.cn/mdd/citylist/21536.html');

    requests::set_cookie("BAIDUID", "FEE96299191CB0F11954F3A0060FB470:FG=1");

    requests::set_useragent(array(
        "Mozilla/4.0 (compatible; MSIE 6.0; ) Opera/UCWEB7.0.2.37/28/",
        "Opera/9.80 (Android 3.2.1; Linux; Opera Tablet/ADR-1109081720; U; ja) Presto/2.8.149 Version/11.10",
        "Mozilla/5.0 (Android; Linux armv7l; rv:9.0) Gecko/20111216 Firefox/9.0 Fennec/9.0"
    ));
};

$spider->start();