use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanPabrikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_perushaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perushaan')->constrained('pabrik')->onDelete('cascade');
            $table->foreignId('id_karyawan')->constrained('users')->onDelete('cascade');
            $table->string('nomor_karyawan')->unique();
            $table->string('jabatan');
            $table->date('tanggal_bergabung');
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan_pabrik');
    }
} 