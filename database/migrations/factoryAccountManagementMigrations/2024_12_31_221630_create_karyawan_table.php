use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nama_karyawan')->constrained('users')->onDelete('cascade');
            $table->string('nomor_karyawan')->unique();
            $table->string('jabatan');
            $table->date('tanggal_bergabung');
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
} 