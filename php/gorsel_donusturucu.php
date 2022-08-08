<?php
    
    class Gorsel_Donusturucu{
      
        protected function get_gorsel_tipi($target_file){
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            return $imageFileType;
        }           
      
        protected function uzantiyi_ayir($image){
            $extension = $this->get_gorsel_tipi($image); //get extension
            $only_name = basename($image, '.'.$extension); // remove extension
            return $only_name;
        }
        function convert_image($convert_type, $target_dir, $image_name, $image_quality=100){          
            $target_dir = "$target_dir/";            
            $image = $target_dir.$image_name;            
            
            $img_name = $this->uzantiyi_ayir($image);
            
         
            if($convert_type == 'png'){
                $binary = imagecreatefromstring(file_get_contents($image));                
                $image_quality = floor(10 - ($image_quality / 10));
                ImagePNG($binary, $target_dir.$img_name.'.'.$convert_type, $image_quality);
                $dosya_yolu = $target_dir.$img_name.'.'.$convert_type;
                self::otomatik_indir($dosya_yolu);
                return $img_name.'.'.$convert_type;
            }
            
         
            if($convert_type == 'jpg'){
                $binary = imagecreatefromstring(file_get_contents($image));
                imageJpeg($binary, $target_dir.$img_name.'.'.$convert_type, $image_quality);
                $dosya_yolu = $target_dir.$img_name.'.'.$convert_type;
                self::otomatik_indir($dosya_yolu);
                return $img_name.'.'.$convert_type;
            }		
           
            if($convert_type == 'webp'){
                $binary = imagecreatefromstring(file_get_contents($image));
                imagewebp($binary, $target_dir.$img_name.'.'.$convert_type, $image_quality);
                $dosya_yolu = $target_dir.$img_name.'.'.$convert_type;
                self::otomatik_indir($dosya_yolu);
                return $img_name.'.'.$convert_type;
            }				
            return false; 
        }

        public function otomatik_indir($dosya_yolu){
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . basename($dosya_yolu) . "\""); 
            readfile($dosya_yolu); 
        }


        public function yeni_klasor_olustur(){
            $hedef=md5(rand());           
            mkdir($hedef);
            return $hedef;
        }

        public function veritabani_kayit($sayac,$dosyaYoluSorgulari,$dosyaAdiSorgulari,$klasorSorgulari){
            include('baglanti.php');
                    for($i=0;$i<$sayac;$i++){
                        $dosyaYoluSorgulari[$i]=trim($dosyaYoluSorgulari[$i],',');
                        $conn->query("INSERT INTO gorsel_bilgileri(klasor,gorselAdi,gorselKonumu) VALUES ($klasorSorgulari[$i]".",".$dosyaAdiSorgulari[$i].","." $dosyaYoluSorgulari[$i])");            
                    }                    
                        
        }


        public function gorsel_yukle($files,$girdi_adi){
            $hedef=self::yeni_klasor_olustur();
            $izinVerilenTurler=array('png','webp','jpg');            
            $dosyaYoluSorgulari=array();
            $klasorSorgulari=array();
            $dosyaAdiSorgulari=array();
            $dosyalar=array_filter($_FILES['files']['name']);
            $sayac=0;
            
            if(!empty($dosyalar)){
                foreach($dosyalar as $key=>$val){                                                         
                    $rast=rand(100,100000);
                    $strRast=(string)$rast;
                    $dosyaAdi=basename($_FILES['files']['name'][$key]);
                    $kaydedilecekKonum=$hedef.'/'.$strRast.$dosyaAdi;

                    //dosya uzantısını verir    
                    $dosyaTuru=pathinfo($kaydedilecekKonum,PATHINFO_EXTENSION);
                    if(in_array($dosyaTuru,$izinVerilenTurler)){

                        if(move_uploaded_file($_FILES['files']['tmp_name'][$key],$kaydedilecekKonum)){

                            $dosyaYoluSorgulari[]=" ('".$kaydedilecekKonum."')";
                            $klasorSorgulari[]=" ('".$hedef."')";
                            $dosyaAdiSorgulari[]=" ('".$strRast.$dosyaAdi."')";     
                            $sayac++;            
                        }else{
                            
                        }
                    }else {

                    }
                }         

                if(!empty($dosyaYoluSorgulari)){
                      self::veritabani_kayit($sayac,$dosyaYoluSorgulari,$dosyaAdiSorgulari,$klasorSorgulari);
                      return $hedef;         
                   
                }else{
                     
                }
            }else{
                 
            }
        }
       
    }

?>