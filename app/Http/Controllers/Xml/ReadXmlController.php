<?php

namespace App\Http\Controllers\Xml;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReadXmlController extends Controller
{
    public function index()
    {
        //dd('chegou');

                //$xmlDataString = file_get_contents('teste.xml');
        //$xmlDataString = file_get_contents(public_path('sample-course.xml'));
                //$dataset = simplexml_load_string($xmlDataString);
                   
        //$json = json_encode($dataset);
        //$dataset = json_decode($json, true); 
   
                //return view('admin.produto.xml_index', [
                    //'dataset' => $dataset,			
                //]);
        //echo "<pre>";
        //print_r($dataset);
        //dd($phpDataArray);


        $xml= simplexml_load_file("fone_ouvido.xml");   
        if (!$xml) {
            echo "Erro ao abrir arquivo!";
            exit;
        } 
        echo '<pre>';
        print_r($xml);
        echo '<br><br>ESPAÇO<br><br>';
        
        $attributes = $xml->attributes();           
        $versao = strval($attributes['versao']);
        
        print_r($versao);

        //echo $xml->emit;



        //NFe

        $children = $xml->children();
        $data = ((array)$children->prod);
        //echo $data['vProd'];



    }
}