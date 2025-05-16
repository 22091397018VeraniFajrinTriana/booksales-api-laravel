/**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('isbn', 13)->unique();
            $table->integer('page_count');
            $table->decimal('price', 10, 2);
            $table->date('published_date');
            $table->string('publisher');
            $table->string('genre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};