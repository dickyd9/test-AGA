public function up()
{
    Schema::create('pegawai', function (Blueprint $table) {
        $table->id(); // Kolom ID otomatis
        $table->string('employee_name');
        $table->string('gender');
        $table->string('phone_number');
        $table->string('address');
        $table->increments('nip'); // Kolom NIP otomatis
        $table->timestamps();
    });
}
