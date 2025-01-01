use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePabrikTable extends Migration
{
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perusahaan')->constrained('pabrik')->onDelete('cascade');
            $table->string('nama_dokumen');
            $table->string('jenis_dokumen');
            