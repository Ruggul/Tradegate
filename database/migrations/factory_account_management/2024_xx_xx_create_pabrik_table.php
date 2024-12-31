use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePabrikTable extends Migration
{
    public function up()
    {
        Schema::create('pabrik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pabrik');
            $table->string('kode_pabrik')->unique();
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('email')->unique();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pabrik');
    }
} 