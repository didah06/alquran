<?php
include 'koneksi.php';
//periksa apakah user telah menekan submit, dengan menggunakan parameter setingan keterangan
if (isset($_POST['submit'])) //pengecekan submit
{
  // PROSES CASE FOLDING
  
    $kalimat_asli = $_POST['isi'];
    $q_kode = 'q';
    mysql_query("TRUNCATE query");
    $inputkan=mysql_query("INSERT INTO query VALUES('','$kalimat_asli')");

    $kalimat = strtolower($kalimat_asli);

    //hilangkan tanda baca
      $kalimat = str_replace("'", " ", $kalimat);  
      $kalimat = str_replace("-", " ", $kalimat);  
      $kalimat = str_replace(")", " ", $kalimat);  
      $kalimat = str_replace("(", " ", $kalimat);       
      $kalimat = str_replace("\"", " ", $kalimat);   
      $kalimat = str_replace("/", " ", $kalimat);  
      $kalimat = str_replace("=", " ", $kalimat);  
      $kalimat = str_replace(".", " ", $kalimat);  
      $kalimat = str_replace(",", " ", $kalimat);  
      $kalimat = str_replace(":", " ", $kalimat);  
      $kalimat = str_replace(";", " ", $kalimat);  
      $kalimat = str_replace("!", " ", $kalimat); 
      $kalimat = str_replace("?", " ", $kalimat); 
      $kalimat = str_replace("`", " ", $kalimat);
      $kalimat = str_replace("~", " ", $kalimat);
      $kalimat = str_replace("@", " ", $kalimat);
      $kalimat = str_replace("#", " ", $kalimat);
      $kalimat = str_replace("$", " ", $kalimat);
      $kalimat = str_replace("%", " ", $kalimat);
      $kalimat = str_replace("^", " ", $kalimat);
      $kalimat = str_replace("&", " ", $kalimat);
      $kalimat = str_replace("*", " ", $kalimat);
      $kalimat = str_replace("_", " ", $kalimat);
      $kalimat = str_replace("+", " ", $kalimat);
      $kalimat = str_replace("[", " ", $kalimat);
      $kalimat = str_replace("]", " ", $kalimat);
      $kalimat = str_replace("<", " ", $kalimat);
      $kalimat = str_replace(">", " ", $kalimat);

    mysql_query("TRUNCATE case_folding1");
    $masukkan=mysql_query("INSERT INTO case_folding1 VALUES('','$kalimat','$q_kode')");  
  // AKHIR DARI CASE FOLDING


  // PROSES TOKENISASI
  mysql_query("TRUNCATE token1");
  $query=mysql_query("SELECT case_folding1, q_code FROM case_folding1") or die(mysql_error());
  while($row=mysql_fetch_array($query))
  {
    $kalimat_asli = $row['case_folding1'];
    $q_kode = $row['q_code'];

    $token = str_word_count(strtolower($kalimat_asli), 1);
    foreach ($token as $key=>$hasil_token)
    {
      $masukkan2=mysql_query("INSERT INTO token1 VALUES('','$hasil_token', '$q_kode')");
    } 

  }
  // AKHIR PROSES TOKENISASI

  // PROSES FILTERING
  class Filtering
  {
     private $stopwords = array("ada", "adalah", "adanya", "adapun", "agak", "agaknya", "agar", "akan", "akankah", "akhir", "akhiri", "akhirnya", "aku", "akulah", "amat", "amatlah", "anda", "andalah", "antar", "antara", "antaranya", "apa", "apaan", "apabila", "apakah", "apalagi", "apatah", "artinya", "asal", "asalkan", "atas", "atau", "ataukah", "ataupun", "awal", "awalnya", "bagai", "bagaikan", "bagaimana", "bagaimanakah", "bagaimanapun", "bagi", "bagian", "bahkan", "bahwa", "bahwasanya", "baik", "bakal", "bakalan", "balik", "banyak", "bapak", "baru", "bawah", "beberapa", "begini", "beginian", "beginikah", "beginilah", "begitu", "begitukah", "begitulah", "begitupun", "bekerja", "belakang", "belakangan", "belum", "belumlah", "benar", "benarkah", "benarlah", "berada", "berakhir", "berakhirlah", "berakhirnya", "berapa", "berapakah", "berapalah", "berapapun", "berarti", "berawal", "berbagai", "berdatangan", "beri", "berikan", "berikut", "berikutnya", "berjumlah", "berkali-kali", "berkata", "berkehendak", "berkeinginan", "berkenaan", "berlainan", "berlalu", "berlangsung", "berlebihan", "bermacam", "bermacam-macam", "bermaksud", "bermula", "bersama", "bersama-sama", "bersiap", "bersiap-siap", "bertanya", "bertanya-tanya", "berturut", "berturut-turut", "bertutur", "berujar", "berupa", "besar", "betul", "betulkah", "biasa", "biasanya", "bila", "bilakah", "bisa", "bisakah", "boleh", "bolehkah", "bolehlah", "buat", "bukan", "bukankah", "bukanlah", "bukannya", "bulan", "bung", "cara", "caranya", "cukup", "cukupkah", "cukuplah", "cuma", "dahulu", "dalam", "dan", "dapat", "dari", "daripada", "datang", "dekat", "demi", "demikian", "demikianlah", "dengan", "depan", "di", "dia", "diakhiri", "diakhirinya", "dialah", "diantara", "diantaranya", "diberi", "diberikan", "diberikannya", "dibuat", "dibuatnya", "didapat", "didatangkan", "digunakan", "diibaratkan", "diibaratkannya", "diingat", "diingatkan", "diinginkan", "dijawab", "dijelaskan", "dijelaskannya", "dikarenakan", "dikatakan", "dikatakannya", "dikerjakan", "diketahui", "diketahuinya", "dikira", "dilakukan", "dilalui", "dilihat", "dimaksud", "dimaksudkan", "dimaksudkannya", "dimaksudnya", "diminta", "dimintai", "dimisalkan", "dimulai", "dimulailah", "dimulainya", "dimungkinkan", "dini", "dipastikan", "diperbuat", "diperbuatnya", "dipergunakan", "diperkirakan", "diperlihatkan", "diperlukan", "diperlukannya", "dipersoalkan", "dipertanyakan", "dipunyai", "diri", "dirinya", "disampaikan", "disebut", "disebutkan", "disebutkannya", "disini", "disinilah", "ditambahkan", "ditandaskan", "ditanya", "ditanyai", "ditanyakan", "ditegaskan", "ditujukan", "ditunjuk", "ditunjuki", "ditunjukkan", "ditunjukkannya", "ditunjuknya", "dituturkan", "dituturkannya", "diucapkan", "diucapkannya", "diungkapkan", "dong", "dua", "dulu", "empat", "enggak", "enggaknya", "entah", "entahlah", "guna", "gunakan", "hal", "hampir", "hanya", "hanyalah", "hari", "harus", "haruslah", "harusnya", "hendak", "hendaklah", "hendaknya", "hingga", "ia", "ialah", "ibarat", "ibaratkan", "ibaratnya", "ibu", "ikut", "ingat", "ingat-ingat", "ingin", "inginkah", "inginkan", "ini", "inikah", "inilah", "itu", "itukah", "itulah", "jadi", "jadilah", "jadinya", "jangan", "jangankan", "janganlah", "jauh", "jawab", "jawaban", "jawabnya", "jelas", "jelaskan", "jelaslah", "jelasnya", "jika", "jikalau", "juga", "jumlah", "jumlahnya", "justru", "kala", "kalau", "kalaulah", "kalaupun", "kalian", "kami", "kamilah", "kamu", "kamulah", "kan", "kapan", "kapankah", "kapanpun", "karena", "karenanya", "kasus", "kata", "katakan", "katakanlah", "katanya", "ke", "keadaan", "kebetulan", "kecil", "kedua", "keduanya", "keinginan", "kelamaan", "kelihatan", "kelihatannya", "kelima", "keluar", "kembali", "kemudian", "kemungkinan", "kemungkinannya", "kenapa", "kepada", "kepadanya", "kesampaian", "keseluruhan", "keseluruhannya", "keterlaluan", "ketika", "khususnya", "kini", "kinilah", "kira", "kira-kira", "kiranya", "kita", "kitalah", "kok", "kurang", "lagi", "lagian", "lah", "lain", "lainnya", "lalu", "lama", "lamanya", "lanjut", "lanjutnya", "lebih", "lewat", "lima", "luar", "macam", "maka", "makanya", "makin", "malah", "malahan", "mampu", "mampukah", "mana", "manakala", "manalagi", "masa", "masalah", "masalahnya", "masih", "masihkah", "masing", "masing-masing", "mau", "maupun", "melainkan", "melakukan", "melalui", "melihat", "melihatnya", "memang", "memastikan", "memberi", "memberikan", "membuat", "memerlukan", "memihak", "meminta", "memintakan", "memisalkan", "memperbuat", "mempergunakan", "memperkirakan", "memperlihatkan", "mempersiapkan", "mempersoalkan", "mempertanyakan", "mempunyai", "memulai", "memungkinkan", "menaiki", "menambahkan", "menandaskan", "menanti", "menanti-nanti", "menantikan", "menanya", "menanyai", "menanyakan", "mendapat", "mendapatkan", "mendatang", "mendatangi", "mendatangkan", "menegaskan", "mengakhiri", "mengapa", "mengatakan", "mengatakannya", "mengenai", "mengerjakan", "mengetahui", "menggunakan", "menghendaki", "mengibaratkan", "mengibaratkannya", "mengingat", "mengingatkan", "menginginkan", "mengira", "mengucapkan", "mengucapkannya", "mengungkapkan", "menjadi", "menjawab", "menjelaskan", "menuju", "menunjuk", "menunjuki", "menunjukkan", "menunjuknya", "menurut", "menuturkan", "menyampaikan", "menyangkut", "menyatakan", "menyebutkan", "menyeluruh", "menyiapkan", "merasa", "mereka", "merekalah", "merupakan", "meski", "meskipun", "meyakini", "meyakinkan", "minta", "mirip", "misal", "misalkan", "misalnya", "mula", "mulai", "mulailah", "mulanya", "mungkin", "mungkinkah", "nah", "naik", "namun", "nanti", "nantinya", "nyaris", "nyatanya", "oleh", "olehnya", "pada", "padahal", "padanya", "pak", "paling", "panjang", "pantas", "para", "pasti", "pastilah", "penting", "pentingnya", "per", "percuma", "perlu", "perlukah", "perlunya", "pernah", "persoalan", "pertama", "pertama-tama", "pertanyaan", "pertanyakan", "pihak", "pihaknya", "pukul", "pula", "pun", "punya", "rasa", "rasanya", "rata", "rupanya", "saat", "saatnya", "saja", "sajalah", "saling", "sama", "sama-sama", "sambil", "sampai", "sampai-sampai", "sampaikan", "sana", "sangat", "sangatlah", "satu", "saya", "sayalah", "se", "sebab", "sebabnya", "sebagai", "sebagaimana", "sebagainya", "sebagian", "sebaik", "sebaik-baiknya", "sebaiknya", "sebaliknya", "sebanyak", "sebegini", "sebegitu", "sebelum", "sebelumnya", "sebenarnya", "seberapa", "sebesar", "sebetulnya", "sebisanya", "sebuah", "sebut", "sebutlah", "sebutnya", "secara", "secukupnya", "sedang", "sedangkan", "sedemikian", "sedikit", "sedikitnya", "seenaknya", "segala", "segalanya", "segera", "seharusnya", "sehingga", "seingat", "sejak", "sejauh", "sejenak", "sejumlah", "sekadar", "sekadarnya", "sekali", "sekali-kali", "sekalian", "sekaligus", "sekalipun", "sekarang", "sekarang", "sekecil", "seketika", "sekiranya", "sekitar", "sekitarnya", "sekurang-kurangnya", "sekurangnya", "sela", "selain", "selaku", "selalu", "selama", "selama-lamanya", "selamanya", "selanjutnya", "seluruh", "seluruhnya", "semacam", "semakin", "semampu", "semampunya", "semasa", "semasih", "semata", "semata-mata", "semaunya", "sementara", "semisal", "semisalnya", "sempat", "semua", "semuanya", "semula", "sendiri", "sendirian", "sendirinya", "seolah", "seolah-olah", "seorang", "sepanjang", "sepantasnya", "sepantasnyalah", "seperlunya", "seperti", "sepertinya", "sepihak", "sering", "seringnya", "serta", "serupa", "sesaat", "sesama", "sesampai", "sesegera", "sesekali", "seseorang", "sesuatu", "sesuatunya", "sesudah", "sesudahnya", "setelah", "setempat", "setengah", "seterusnya", "setiap", "setiba", "setibanya", "setidak-tidaknya", "setidaknya", "setinggi", "seusai", "sewaktu", "siap", "siapa", "siapakah", "siapapun", "sini", "sinilah", "soal", "soalnya", "suatu", "sudah", "sudahkah", "sudahlah", "supaya", "tadi", "tadinya", "tahu", "tahun", "tak", "tambah", "tambahnya", "tampak", "tampaknya", "tandas", "tandasnya", "tanpa", "tanya", "tanyakan", "tanyanya", "tapi", "tegas", "tegasnya", "telah", "tempat", "tengah", "tentang", "tentu", "tentulah", "tentunya", "tepat", "terakhir", "terasa", "terbanyak", "terdahulu", "terdapat", "terdiri", "terhadap", "terhadapnya", "teringat", "teringat-ingat", "terjadi", "terjadilah", "terjadinya", "terkira", "terlalu", "terlebih", "terlihat", "termasuk", "ternyata", "tersampaikan", "tersebut", "tersebutlah", "tertentu", "tertuju", "terus", "terutama", "tetap", "tetapi", "tiap", "tiba", "tiba-tiba", "tidak", "tidakkah", "tidaklah", "tiga", "tinggi", "toh", "tunjuk", "turut", "tutur", "tuturnya", "ucap", "ucapnya", "ujar", "ujarnya", "umum", "umumnya", "ungkap", "ungkapnya", "untuk", "usah", "usai", "waduh", "wah", "wahai", "waktu", "waktunya", "walau", "walaupun", "wong", "yaitu", "yakin", "yakni", "yang");

     public function getToken($token, $q_kode, $nbrwords2 = 5)
     {
        $filter= str_word_count($token, 1);
        array_walk($filter, array(
           $this,
           'filter'
        ));
        $filter = array_diff($filter, $this->stopwords);
        $wordCount = array_count_values($filter);
        arsort($wordCount);

        $jumlah = count($wordCount);
        foreach ($wordCount as $key=>$hasil) 
        {
           $masukkan3=mysql_query("INSERT INTO filtering1 VALUES('', '$key', '$q_kode')");
        }
              $wordCount = array_slice($wordCount, 0, $nbrwords2);
              return array_keys($wordCount);
     }
     private function filter(&$hasil, $key)
     {
        $hasil = strtolower($hasil);
     }
     private function setStopwords()
     {
        $this->stopwords = array();
     }
  }

  $test = new Filtering();
  mysql_query("TRUNCATE filtering1");
  $query=mysql_query("SELECT term, q_code FROM token1") or die(mysql_error());
  while($row=mysql_fetch_array($query))
  {
    $token = $row['term'];
    $q_kode = $row['q_code'];
    $proses = $test->getToken($token, $q_kode, 9);
  }
  // AKHIR PROSES FILTERING

  // PROSES STEMMING
  include "stemming.php";
  mysql_query("TRUNCATE stemming1");
  $query=mysql_query("SELECT term, q_code FROM filtering1") or die(mysql_error());
  while($row=mysql_fetch_array($query))
  {
    $kata = $row['term'];
    $q_kode= $row['q_code'];
    $hasil = stemming($kata);
    $masukkan4=mysql_query("INSERT INTO stemming1 VALUES('','$hasil','$q_kode')");
  }
  // AKHIR PROSES STEMMING


// PROSES PERHITUNGAN TF
//ambil semua data(teks)  
  mysql_query("TRUNCATE q_index;");    
  $pengaduan = mysql_query("SELECT id FROM query") or die(mysql_error());
  $num_rows = mysql_num_rows($pengaduan);

  $query= mysql_query("SELECT term FROM stemming1 ORDER BY id") or die(mysql_error());
  while($row=mysql_fetch_array($query))
  {
  $token = $row['term'];
  $proses_token = explode(" ", trim($token));  // proses menghilangkan ganda

     foreach ($proses_token as $j => $value) {                         
       //hanya jika Term tidak null atau nil, tidak kosong                        
       if ($proses_token[$j] != "") {                      
                           
          //berapa baris hasil yang dikembalikan query tersebut?                           
          $rescount = mysql_query("SELECT Count FROM q_index  WHERE Term = '$proses_token[$j]'") or die(mysql_error());        
          $num_rows = mysql_num_rows($rescount);
                          
          //jika sudah ada DocId dan Term tersebut , naikkan 
          Count (+1);  

          if ($num_rows > 0) {                           
                 $rowcount = mysql_fetch_array($rescount);                                               
                 $count = $rowcount['Count'];
                 $count++;
                                                                    
                 mysql_query("UPDATE q_index SET Count = $count WHERE Term = '$proses_token[$j]'") or die(mysql_error());
          }
          //jika belum ada, langsung simpan ke tbindex                 
          else
          {                    
                 mysql_query("INSERT INTO q_index (Term, Count) VALUES ('$proses_token[$j]', 1)") or die(mysql_error());
          }
       } //end if
     } //end foreach
   
  } // end while  
// AKHIR PROSES PERHITUNGAN TF UNTUK QUERY

// PROSES PERHITUNGAN TF-IDF UNTUK QUERY
//berapa jumlah DocId total?, n
   $resn = mysql_query("SELECT DISTINCT DocId FROM tbindex");
   $n = mysql_num_rows($resn);
  
   //ambil setiap record dalam tabel tbindex
   //hitung bobot untuk setiap Term dalam setiap DocId
   $resBobot = mysql_query("SELECT Id, Term, Count FROM q_index ORDER BY Id");
   while($rowbobot = mysql_fetch_array($resBobot))
   {
      //$w = tf * log (n/N)
      $term = $rowbobot['Term'];
      $tf = $rowbobot['Count'];
      $id = $rowbobot['Id'];
      //berapa jumlah dokumen yang mengandung term tersebut?, N
      $resNTerm = mysql_query("SELECT Count(*) as N FROM tbindex  WHERE Term = '$term'");
      $rowNTerm = mysql_fetch_array($resNTerm);
      $NTerm = $rowNTerm['N'];
     
      $w = $tf * @log10($n/$NTerm);
      //update bobot dari term tersebut
      $resUpdateBobot = mysql_query("UPDATE q_index SET Weight = $w WHERE Id = $id");             
   } //end while $rowbobot
// PROSES AKHIR PERHITUNGAN TF-IDF UNTUK QUERY
if($resUpdateBobot){
    ?>
    <script language="JavaScript">
      alert('Successfully');
      window.location=history.go(-1);
    </script>
    <?php
}else
{
    ?>
    <script language="JavaScript">
      alert('Failed');
      window.location=history.go(-1);
    </script>
    <?php
}
// PROSES AKHIR TAMPILKAN HASIL PERHITUNGAN
}
?>