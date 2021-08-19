<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Spatie\Browsershot\Browsershot;

class WordController extends Controller
{

    public function baca(Request $request){
        $rules=[
            'file' => 'required|file',
        ];

        $validasi= \Validator::make($request->all(), $rules);

        if($validasi->fails()){
            return redirect()
                ->back()
                ->with('message','<div class="alert alert-danger">Silahkan pilih file terlebih dahulu</div>');
        }else{
            
            $file = $request->file('file');
            $ext_file = $file->getClientOriginalExtension();
            
            $tujuan_upload = "uploads/file";
            $namafile=time().$file->getClientOriginalName();

            $path = $file->storeAs('public/file/', $namafile);

            $source = storage_path('app/public/file/'.$namafile);
            
            if($ext_file == "docx" || $ext_file == "doc")
            {
                try {
                    $phpWord = IOFactory::createReader('Word2007')->load($source);
                    // dd($phpWord->getSections());
                    $list = array();
    
                    foreach($phpWord->getSections() as $val=>$section){
                        // dd($section);
                        foreach($section->getElements() as $element){
                            // dd($element->getElements());
                            $text = array();
                            if(method_exists($element, 'getElements'))
                            {
                                foreach($element->getElements() as $el){
                                    // dd($el);
                                    // dd($el->getFontStyle()->getColor());
                                    $source = null;
                                    if(method_exists($el, 'getSource'))
                                    {
                                        $source = $el->getSource();
                                    }   
    
                                    $text[]=array(
                                        'source'=>$source,
                                        'text'=>$el->getText(),
                                        'style'=>array(
                                            'name'=>$el->getFontStyle()->getName(),
                                            'type'=>$el->getFontStyle()->getSize(),
                                            'bold'=>$el->getFontStyle()->getBold(),
                                            'italic'=>$el->getFontStyle()->getItalic(),
                                            'underline'=>$el->getFontStyle()->getUnderLine(),
                                            'fgColor'=>$el->getFontStyle()->getFGColor(),
                                            'color'=>$el->getFontStyle()->getColor(),
                                            'styleName'=>$el->getFontStyle()->getStyleName(),
                                        )
                                    );
                                }
                            }
    
                            $list[] = array( 
                                'text'=>$text
                            );
                        }
                    }
    
                    return view('baca')
                        ->with('list', $list)
                        ->with('namafile', $namafile);
                } catch (Exception $e) {
                    return $e;
                }   
            }
        }
        
    }
}
