<?php
// PROSES CASE FOLDING
include ("koneksi.php");
$query=mysql_query("TRUNCATE case_folding") or die(mysql_error());
$query=mysql_query("SELECT * FROM dokumen") or die(mysql_error());
while($row=mysql_fetch_array($query))
{
  $surat_id = $row['SuraID'];
  $kalimat_asli = $row['terjemahan_ayat'];
  $no_ayat = $row['no_ayat'];

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
  
  $masukkan=mysql_query("INSERT INTO case_folding VALUES('','$kalimat','$surat_id','$no_ayat')"); 
  
}


// AKHIR DARI CASE FOLDING
// PROSES TOKENISASI
$query=mysql_query("TRUNCATE token") or die(mysql_error());
$query=mysql_query("SELECT * FROM case_folding") or die(mysql_error());
while($row=mysql_fetch_array($query))
{
  $kalimat_asli = $row['case_folding'];
  $surat_id = $row['SuraID'];
  $no_ayat = $row['no_ayat'];

  $token = str_word_count(strtolower($kalimat_asli), 1);
  foreach ($token as $key=>$hasil_token)
  {
    $masukkan2=mysql_query("INSERT INTO token VALUES('','$hasil_token', '$surat_id','$no_ayat')");
  } 

}
// AKHIR PROSES TOKENISASI


// PROSES FILTERING
class Filtering
{
   private $stopwords = array("a", "about", "above", "acara", "across", "ada", "adalah", "adanya", "after", "afterwards", "again", "against", "agar", "akan", "akhir", "akhirnya", "akibat", "aku", "all", "almost", "alone", "along", "already", "also", "although", "always", "am", "among", "amongst", "amoungst", "amount", "an", "and", "anda", "another", "antara", "any", "anyhow", "anyone", "anything", "anyway", "anywhere", "apa", "apakah", "apalagi", "are", "around", "as", "asal", "at", "atas", "atau", "awal", "b", "back", "badan", "bagaimana", "bagi", "bagian", "bahkan", "bahwa", "baik", "banyak", "barang", "barat", "baru", "bawah", "be", "beberapa", "became", "because", "become", "becomes", "becoming", "been", "before", "beforehand", "begitu", "behind", "being", "belakang", "below", "belum", "benar", "bentuk", "berada", "berarti", "berat", "berbagai", "berdasarkan", "berjalan", "berlangsung", "bersama", "bertemu", "besar", "beside", "besides", "between", "beyond", "biasa", "biasanya", "bila", "bill", "bisa", "both", "bottom", "bukan", "bulan", "but", "by", "call", "can", "cannot", "cant", "cara", "co", "con", "could", "couldnt", "cry", "cukup", "dalam", "dan", "dapat", "dari", "datang", "de", "dekat", "demikian", "dengan", "depan", "describe", "detail", "di", "dia", "diduga", "digunakan", "dilakukan", "diri", "dirinya", "ditemukan", "do", "done", "down", "dua", "due", "dulu", "during", "each", "eg", "eight", "either", "eleven", "else", "elsewhere", "empat", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "gedung", "get", "give", "go", "had", "hal", "hampir", "hanya", "hari", "harus", "has", "hasil", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "hidup", "him", "himself", "hingga", "his", "how", "however", "hubungan", "hundred", "ia", "ie", "if", "ikut", "in", "inc", "indeed", "ingin", "ini", "interest", "into", "is", "it", "its", "itself", "itu", "jadi", "jalan", "jangan", "jauh", "jelas", "jenis", "jika", "juga", "jumat", "jumlah", "juni", "justru", "juta", "kalau", "kali", "kami", "kamis", "karena", "kata", "katanya", "ke", "kebutuhan", "kecil", "kedua", "keep", "kegiatan", "kehidupan", "kejadian", "keluar", "kembali", "kemudian", "kemungkinan", "kepada", "keputusan", "kerja", "kesempatan", "keterangan", "ketiga", "ketika", "khusus", "kini", "kita", "kondisi", "kurang", "lagi", "lain", "lainnya", "lalu", "lama", "langsung", "lanjut", "last", "latter", "latterly", "least", "lebih", "less", "lewat", "lima", "ltd", "luar", "made", "maka", "mampu", "mana", "mantan", "many", "masa", "masalah", "masih", "masing-masing", "masuk", "mau", "maupun", "may", "me", "meanwhile", "melakukan", "melalui", "melihat", "memang", "membantu", "membawa", "memberi", "memberikan", "membuat", "memiliki", "meminta", "mempunyai", "mencapai", "mencari", "mendapat", "mendapatkan", "menerima", "mengaku", "mengalami", "mengambil", "mengatakan", "mengenai", "mengetahui", "menggunakan", "menghadapi", "meningkatkan", "menjadi", "menjalani", "menjelaskan", "menunjukkan", "menurut", "menyatakan", "menyebabkan", "menyebutkan", "merasa", "mereka", "merupakan", "meski", "might", "milik", "mill", "mine", "minggu", "misalnya", "more", "moreover", "most", "mostly", "move", "much", "mulai", "muncul", "mungkin", "must", "my", "myself", "nama", "name", "namely", "namun", "nanti", "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "oleh", "on", "once", "one", "only", "onto", "or", "orang", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own", "pada", "padahal", "pagi", "paling", "panjang", "para", "part", "pasti", "pekan", "penggunaan", "penting", "per", "perhaps", "perlu", "pernah", "persen", "pertama", "pihak", "please", "posisi", "program", "proses", "pula", "pun", "punya", "put", "rabu", "rasa", "rather", "re", "ribu", "ruang", "saat", "sabtu", "saja", "salah", "sama", "same", "sampai", "sangat", "satu", "saya", "sebab", "sebagai", "sebagian", "sebanyak", "sebelum", "sebelumnya", "sebenarnya", "sebesar", "sebuah", "secara", "sedang", "sedangkan", "sedikit", "see", "seem", "seemed", "seeming", "seems", "segera", "sehingga", "sejak", "sejumlah", "sekali", "sekarang", "sekitar", "selain", "selalu", "selama", "selasa", "selatan", "seluruh", "semakin", "sementara", "sempat", "semua", "sendiri", "senin", "seorang", "seperti", "sering", "serious", "serta", "sesuai", "setelah", "setiap", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "suatu", "such", "sudah", "sumber", "system", "tahu", "tahun", "tak", "take", "tampil", "tanggal", "tanpa", "tapi", "telah", "teman", "tempat", "ten", "tengah", "tentang", "tentu", "terakhir", "terhadap", "terjadi", "terkait", "terlalu", "terlihat", "termasuk", "ternyata", "tersebut", "terus", "terutama", "tetapi", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "tidak", "tiga", "tinggal", "tinggi", "tingkat", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "ujar", "umum", "un", "under", "until", "untuk", "up", "upaya", "upon", "us", "usai", "utama", "utara", "very", "via", "waktu", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "wib", "will", "with", "within", "without", "would", "ya", "yaitu", "yakni", "yang", "yet", "you", "your", "yours", "yourself", "yourselves");

   public function getToken($token, $surat_id, $no_ayat, $nbrwords2 = 5)
   {
      $surat_id = $surat_id;
      $no_ayat = $no_ayat;
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
     $masukkan3=mysql_query("INSERT INTO filtering VALUES('', '$key','$surat_id', '$no_ayat')");
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

$query=mysql_query("TRUNCATE filtering") or die(mysql_error());
$test = new Filtering();
$query=mysql_query("SELECT * FROM token") or die(mysql_error());
while($row=mysql_fetch_array($query))
{
  $token = $row['term'];
  $surat_id = $row['SuraID'];
  $no_ayat = $row['no_ayat'];
  $proses = $test->getToken($token,$surat_id, $no_ayat, 9);
}

// AKHIR PROSES FILTERING
// PROSES STEMMING
mysql_query("TRUNCATE stemming");
include "stemming.php"; //memanggil file dari luar file ini
$query=mysql_query("SELECT * FROM filtering") or die(mysql_error());
while($row=mysql_fetch_array($query))
{
  $kata = $row['term'];
  $surat_id = $row['SuraID'];
  $no_ayat= $row['no_ayat'];
  $hasil = stemming($kata);
  if($hasil !=""){
     $masukkan4=mysql_query("INSERT INTO stemming VALUES('','$hasil','$surat_id','$no_ayat')");
  }
}
// AKHIR PROSES STEMMING

// PROSES PERHITUNGAN TF
//ambil semua data(teks) 
  mysql_query("TRUNCATE tbindex");     
  $pengaduan = mysql_query("SELECT * FROM dokumen ORDER BY id") or die(mysql_error());
  $num_rows = mysql_num_rows($pengaduan);

  $query= mysql_query("SELECT * FROM stemming ORDER BY id") or die(mysql_error());
  while($row=mysql_fetch_array($query))
  {
  $id_dok = $row['id'];
  $token = $row['term'];
  $proses_token = explode(" ", trim($token));  // proses menghilangkan ganda

     foreach ($proses_token as $j => $value) {                         
       //hanya jika Term tidak null atau nil, t idak kosong                        
       if ($proses_token[$j] != "") {                      
                           
          //berapa baris hasil yang dikembalikan query tersebut?                           
          $rescount = mysql_query("SELECT Count FROM tbindex  WHERE Term = '$proses_token[$j]' AND DocId = $id_dok") or die(mysql_error());        
          $num_rows = mysql_num_rows($rescount);
                          
          //jika sudah ada DocId dan Term tersebut , naikkan 
          Count (+1);  

          if ($num_rows > 0) {                           
                 $rowcount = mysql_fetch_array($rescount);                                               
                 $count = $rowcount['Count'];
                 $count++;
                                                                    
                 mysql_query("UPDATE tbindex SET Count = $count WHERE Term = '$proses_token[$j]' AND DocId = $id_dok") or die(mysql_error());
          }
          //jika belum ada, langsung simpan ke tbindex                 
          else
          {                    
                 mysql_query("INSERT INTO tbindex (Term, DocId, Count) VALUES ('$proses_token[$j]', $id_dok, 1)") or die(mysql_error());
          }
       } //end if
     } //end foreach
   
  } // end while  
// AKHIR PROSES PERHITUNGAN TF


// PROSES PERHITUNGAN TF-IDF PER KATA TIAP DOKUMEN
//berapa jumlah DocId total?, n
   $resn = mysql_query("SELECT DISTINCT DocId FROM tbindex");
   $n = mysql_num_rows($resn);
  
   //ambil setiap record dalam tabel tbindex
   //hitung bobot untuk setiap Term dalam setiap DocId
   $resBobot = mysql_query("SELECT * FROM tbindex ORDER BY Id");
   $num_rows = mysql_num_rows($resBobot);

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
     
      $w = $tf * log10($n/$NTerm);
     
      //update bobot dari term tersebut
      $resUpdateBobot = mysql_query("UPDATE tbindex SET Weight = $w WHERE Id = $id");             
   } //end while $rowbobot 
// PROSES PERHITUNGAN TF-IDF PER KATA TIAP DOKUMEN

// PROSES TAMPILKAN HASIL PERHITUNGAN
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
?>