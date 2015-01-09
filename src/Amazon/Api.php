<?php
namespace Amazon;

use \Exception;
class Api {
    CONST LOGIN    = "https://kindle.amazon.co.jp/login";
    CONST ENDPOINT = "https://kindle.amazon.co.jp/your_reading";
    CONST PRODUCT_PAGE = "http://www.amazon.co.jp/book/dp/%s";
    protected $login_id;
    protected $login_pass;

    protected $client;
    protected $crawler;
    protected $list;

    public function __construct(\Goutte\Client $client) {
        try {
            $this->client = $client;
            $this->login_id = $_ENV['AMAZON_LOGIN_ID'];
            $this->login_pass = $_ENV['AMAZON_LOGIN_PASS'];

            $this->login();
            $this->getListPage();
            $this->getList();

            return $this;
        } catch(Exception $e) {
            print $e->getMessage().PHP_EOL;
            print $e->getFile().":".$e->getLine().PHP_EOL;
            exit();
        }
    }

    private function login() {
        try {
            $this->crawler = $this->client->request("GET",self::LOGIN);
            $form = $this->crawler->selectButton("次に進む")->form();
            $this->crawler = $this->client->submit($form, array('email' => $this->login_id, 'password' => $this->login_pass));
        } catch(Exception $e) {

        }

    }

    private function getListPage() {
        $link = $this->crawler->filter(".mainNav > ul:nth-child(1) > li:nth-child(1) > a:nth-child(1)")->link();
        $this->crawler = $this->client->click($link);
    }

    private function getList() {
        while(true) {
            $this->crawler->filter("#yourReadingList > tbody > tr")->reduce(function($node) {
                $kindle = new Kindle;
                $kindle->title  = trim($node->filter("td.titleAndAuthor > a")->text());
                $kindle->author = trim($node->filter("td.titleAndAuthor > span")->text());
                $kindle->cover  = str_replace("._SX50_SY60_","",$node->filter("td.coverImage > img.bookCover")->attr("src"));
                $kindle->asin   = $node->filter("input[name=asin]")->attr("value");
                $kindle->url    = sprintf(self::PRODUCT_PAGE,$kindle->asin);

                $this->list[] = $kindle;
                $kindle = null;
            });
            try {
                $link = $this->crawler->selectLink('Next >')->link();
                $this->crawler = $this->client->click($link);
            } catch(Exception $e) {
                break;
            } catch(\InvalidArgumentException $e) {
                exit($e->getMessage());
            }
        }
    }

    public function get() {
        return new $this->list;
    }
}
