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
class MedicalHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalHistory';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date_history')
                ->minDate(now()->subYears(150))
                ->maxDate(now())
                ->label('Date Medical History')
                ->required(),
                
                    Grid::make(2)
                    ->schema([
                        TextArea::make('general_history')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('General History'),

                        TextArea::make('personal_social_history')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Personal/Social History'),
                    ]),

                    Grid::make(2)
                    ->schema([
                        TextArea::make('family_history')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Family History'),

                        TextArea::make('allergies')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Allergies'),
                    ]),

                    Grid::make(2)
                    ->schema([
                        TextArea::make('past_medications')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Past Medications'),

                        TextArea::make('chief_complaint')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Chief Complaint'),
                    ]),

                    Grid::make(2)
                    ->schema([
                        TextArea::make('assessment')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Assessment/Diagnosis'),

                        TextArea::make('physical_examination')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Physical Examination'),
                    ]),

                    Grid::make(2)
                    ->schema([
                        TextArea::make('treatment')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Treatment/Medication'),

                        TextArea::make('lab_results')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Lab Results'),
                    ]),

                    Grid::make(2)
                    ->schema([
                        TextArea::make('progress_notes')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Progress Notes'),

                        TextArea::make('remarks')
                        ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                        ->label('Remarks'),
                    ]),

                    Grid::make(3)
                    ->schema([
                        TextArea::make('birth_term')
                        ->label('Birth Term'),

                        TextArea::make('birth_weight')
                        ->label('Birth Weight'),

                        TextArea::make('birth_length')
                        ->label('Birth Length'),
                    ]),

                    Grid::make(3)
                    ->schema([
                        TextArea::make('bmi')
                        ->label('BMI'),

                        TextArea::make('temperature')
                        ->label('Temparature (°C)'),

                        TextArea::make('blood_pressure')
                        ->label('Blood Pressure'),
                    ]),
                    
                    Grid::make(4)
                    ->schema([
                        TextArea::make('heart_rate')
                        ->label('Heart Rate'),

                        TextArea::make('respiratory_rate')
                        ->label('Respiratory Rate'),

                        TextArea::make('height')
                        ->label('Height(cm)'),

                        TextArea::make('weight')
                        ->label('Weight(kg)'),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_history')
                ->sortable()
                ->label('Date History'),
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
