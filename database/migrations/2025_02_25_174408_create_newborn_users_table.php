<?php

use App\Models\Food;
use App\Models\Placement;
use App\Models\Position;
use App\Models\Season;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('newborn_users', function (Blueprint $table) {
            $table->id();
            $table->decimal('length', 5, 2)->nullable(); // الطول
            $table->decimal('weight', 5, 2)->nullable(); // الوزن
            $table->string('hair_color', 50)->nullable(); // لون الشعر
            $table->string('eye_color', 50)->nullable(); // لون العيون
            $table->string('skin_color', 50)->nullable(); // لون البشرة
            $table->text('father_notes')->nullable(); // ملاحظات عن الأب
            $table->text('mother_notes')->nullable(); // ملاحظات عن الأم
            $table->text('siblings_notes')->nullable(); // ملاحظات عن الإخوة والأخوات
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Food::class)->constrained()->cascadeOnDelete();
            $table->string('other_food')->nullable();
            $table->foreignIdFor(Placement::class)->constrained()->cascadeOnDelete();
            $table->string('other_address')->nullable();
            $table->foreignIdFor(Position::class)->constrained()->cascadeOnDelete();
            $table->string('other_position')->nullable();
            $table->foreignIdFor(Season::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newborn_users');
    }
};
