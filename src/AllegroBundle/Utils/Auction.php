<?php

namespace AllegroBundle\Utils;
use \SoapClient;
use \stdClass;

define('ALLEGRO_LOGIN', 'ip_net');
define('ALLEGRO_PASSWORD', 'f44b0aaa0c620ce1');
define('ALLEGRO_KEY', 'sf44b0aa');
define('ALLEGRO_COUNTRY', 1); // Polska
define('WSDL', 'https://webapi.allegro.pl.webapisandbox.pl/service.php?wsdl');

class Auction {
    const COUNTRY_PL = 1;
    const COUNTRY_TESTWEBAPI = 228;
    const QUERY_ALLEGROWEBAPI = 1;

    const LIFETIME_3DAYS = 0;
    const LIFETIME_5DAYS = 1;
    const LIFETIME_7DAYS = 2;
    const LIFETIME_10DAYS = 3;
    const LIFETIME_14DAYS = 4;


    const TRANSPORT_COST_SELLER = 0;
    const TRANSPORT_COST_BUYER = 1;


    const TRANSPORT_OPTION_POST = 1;
    const TRANSPORT_OPTION_POSTPRIORITY = 2;
    const TRANSPORT_OPTION_COURIER = 4;
    const TRANSPORT_OPTION_PERSONAL = 8;
    const TRANSPORT_OPTION_OTHER = 16;
    const TRANSPORT_OPTION_ABROAD = 32;


    const PAYMENT_OPTION_PREPAID = 1;
    const PAYMENT_OPTION_POSTPAID = 2;
    const PAYMENT_OPTION_ALLEGRO = 4;
    const PAYMENT_OPTION_ESCROW = 8;
    const PAYMENT_OPTION_OTHER = 16;

    const OPTION_BOLD = 1;
    const OPTION_THUMB = 2;
    const OPTION_HIGHLIGHT = 4;
    const OPTION_PREMIUM = 8;
    const OPTION_CATEGORY = 16;

    const KAT_AKCESORIA = 110917;
    const KAT_BLACHY_I_FORMY = 110916;
    const KAT_CHLEBAKI = 49871;
    const KAT_DESKI_DO_KROJENIA = 68722;
    const KAT_GARNKI_I_PATELNIE = 15978;
    const KAT_MASELNICZKI = 68724;
    const KAT_MISKI = 110932;
    const KAT_POJEMNIKI = 15979;
    const KAT_PRZECHOWYWANIE_ZYWNOSCI = 110937;
    const KAT_INNE_INNE_INNE = 1051;

    const OPTION_HOME = 32;

 	protected $client;
 	protected $session;

	public function __construct()
	{
		$this->client = new SoapClient(WSDL);

		$doquerysysstatus_request = array(
		   'sysvar' => 3,
		   'countryId' => ALLEGRO_COUNTRY,
		   'webapiKey' => ALLEGRO_KEY
		);

		$version = $this->client->doQuerySysStatus($doquerysysstatus_request);

		$dologin_request = array(
		   'userLogin' => ALLEGRO_LOGIN,
		   'userPassword' => ALLEGRO_PASSWORD,
		   'countryCode' => ALLEGRO_COUNTRY,
		   'webapiKey' => ALLEGRO_KEY,
		   'localVersion' => $version->verKey
		);

		$this->session = $this->client->doLogin($dologin_request);
	}

/**
 * Redukuje obraz do wielkości nadającej się do przesyłu.
 * 
 * @param string $url URL obrazka (lokalne, albo sieciowe).
 * @return string Binarna zawartość obrazka w formacie JPEG.
 */
    public static function resize($url)
    {
        $image = file_get_contents($url);

        // właśnie tutaj używamy Base64 ręcznie, ale nigdzie indziej!
        while( strlen( base64_encode($image) ) > 200000)
        {
            $temp = imagecreatefromstring($image);
            $x = ceil(0.9 * imagesx($temp) );
            $y = ceil(0.9 * imagesy($temp) );

            $image = imagecreatetruecolor($x, $y);
            imagecopyresized($image, $temp, 0, 0, 0, 0, $x, $y, imagesx($temp), imagesy($temp) );

            imagejpeg($image, 'temp.jpg', 75);
            $image = file_get_contents('temp.jpg');
            unlink('temp.jpg');
        }

        return $image;
    }

	public function newAuction() 
	{
		try {
		    $empty = new stdClass();
		    $empty->{'fvalueString'} = '';
		    $empty->{'fvalueInt'} = 0;
		    $empty->{'fvalueFloat'} = 0;
		    // to pole w formie pustej ma zawierać spację
		    $empty->{'fvalueImage'} = ' ';
		    $empty->{'fvalueDatetime'} = 0;
		    $empty->{'fvalueBoolean'} = false;

		    $form = array();

		    // pamiętaj, że maksymalna długość 50 "znaków" liczona jest w bajtach, dlatego polskie znaki, czy encje HTMLa liczone są za kilka bajtów
		    $field = clone $empty;
		    $field->{'fid'} = 1;
		    $field->{'fvalueString'} = 'miska';
		    $form[] = $field;

		    // kategoria
		    $field = clone $empty;
		    $field->{'fid'} = 2;
		    $field->{'fvalueInt'} = Auction::KAT_POJEMNIKI;
		    $form[] = $field;

		    $field = clone $empty;
		    $field->{'fid'} = 3;
		    $field->{'fvalueDatetime'} = time();
		    $form[] = $field;

		    $field = clone $empty;
		    $field->{'fid'} = 4;
		    $field->{'fvalueInt'} = Auction::LIFETIME_7DAYS;
		    $form[] = $field;

		    // liczba sztuk
		    $field = clone $empty;
		    $field->{'fid'} = 5;
		    $field->{'fvalueInt'} = 69;
		    $form[] = $field;

		    // cena kup teraz
		    $field = clone $empty;
		    $field->{'fid'} = 8;
		    $field->{'fvalueFloat'} = 666;
		    $form[] = $field;

		    // kraj
		    $field = clone $empty;
		    $field->{'fid'} = 9;
		    $field->{'fvalueInt'} = Auction::COUNTRY_PL;
		    $form[] = $field;

		    // 16 to województwo zachodniopomorskie, numer województwa można pobrać z listy opisu pola
		    $field = clone $empty;
		    $field->{'fid'} = 10;
		    $field->{'fvalueInt'} = 16;
		    $form[] = $field;

		    $field = clone $empty;
		    $field->{'fid'} = 11;
		    $field->{'fvalueString'} = 'Szczecin';
		    $form[] = $field;

		    // kod pocztowy
		    $field = clone $empty;
		    $field->{'fid'} = 32;
		    $field->{'fvalueString'} = '43-227';
		    $form[] = $field;

		    $field = clone $empty;
		    $field->{'fid'} = 12;
		    $field->{'fvalueInt'} = Auction::TRANSPORT_COST_BUYER;
		    $form[] = $field;

		    // paczka pocztowa priorytetowa
		    $field = clone $empty;
		    $field->{'fid'} = 38;
		    $field->{'fvalueFloat'} = 11.00;
		    $form[] = $field;

		    // stan
		    $field = clone $empty;
		    $field->{'fid'} = 20634;
		    $field->{'fvalueInt'} = 1;
		    $form[] = $field;

		    // flagi składamy przez ich logiczne sumowanie
		    $field = clone $empty;
		    $field->{'fid'} = 13;
		    $field->{'fvalueInt'} = Auction::TRANSPORT_OPTION_POST | Auction::TRANSPORT_OPTION_POSTPRIORITY;
		    $form[] = $field;

		    $field = clone $empty;
		    $field->{'fid'} = 14;
		    $field->{'fvalueInt'} = Auction::PAYMENT_OPTION_PREPAID | Auction::PAYMENT_OPTION_ALLEGRO;
		    $form[] = $field;

		    $field = clone $empty;
		    $field->{'fid'} = 15;
		    $field->{'fvalueInt'} = Auction::OPTION_BOLD | Auction::OPTION_THUMB | Auction::OPTION_HIGHLIGHT;
		    $form[] = $field;

		    $i = 0;

		    // maksymalnie 8 zdjęć!
		    foreach( array('http://2.bp.blogspot.com/-zFUv9KBF0ds/VBh_RyYvroI/AAAAAAAAcOQ/zU3EAaCDkeQ/s1600/SAM_7805.JPG') as $image)
		    {
		        $field = clone $empty;
		        $field->{'fid'} = 16 + $i;
		        $field->{'fvalueImage'} = Auction::resize($image);
		        $form[] = $field;
		        $i++;
		    }

		    $field = clone $empty;
		    $field->{'fid'} = 24;
		    $field->{'fvalueString'} = '<h1>Opis</h1>

		<p>Nasza aukcja - powered by <a href="http://wrzasq.pl/" title="Tworzenie stron i aplikacji internetowych">Wrzasq.pl</a>.</p>

		<div><GALERIA></div>.';
		    $form[] = $field;
		    $local = uniqid();

		    $donewauctionext_request = array('sessionHandle' => $this->session->sessionHandlePart, 'fields' => $form, 'itemTemplateId' => 0, 'localId' => $local);

		    $item = $this->client->doNewAuctionExt($donewauctionext_request);

			$doverifyitem_request = array(
			   'sessionHandle' => $this->session->sessionHandlePart,
			   'localId' => $local
			);

		    $check = $this->client->doVerifyItem($doverifyitem_request);

		    if($item->itemId == $check)
		    {
		        echo '<p>Wystawiono przedmiot <a href="http://allegro.pl/item' . $item['item-id'] . '.html">' . $item['item-id'] . '</a>.</p>';
		    }
		    else
		    {
		        echo '<p class="error">Coś poszło nie tak.</p>';
		    }
		} catch(Exception $e) {
		    echo $e;
		}
	}
}