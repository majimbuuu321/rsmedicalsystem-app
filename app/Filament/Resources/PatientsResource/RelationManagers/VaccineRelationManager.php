<?php

namespace App\Filament\Resources\PatientsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
class VaccineRelationManager extends RelationManager
{
    protected static string $relationship = 'vaccine';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date_administered')
                ->minDate(now()->subYears(150))
                ->maxDate(now())
                ->label('Date Administered')
                ->required(),

                Grid::make(2)
                ->schema([
                    TextInput::make('vaccine_name')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->label('Vaccine Name')
                    ->required(),

                    TextInput::make('vaccine_type')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->label('Vaccine Type'),
                ]),
                TextArea::make('vaccine_reaction')
                ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                ->label('Vaccine Reaction'),
                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
             
            ->columns([
                TextColumn::make('date_administered')
                ->sortable()
                ->label('Date Administered'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
