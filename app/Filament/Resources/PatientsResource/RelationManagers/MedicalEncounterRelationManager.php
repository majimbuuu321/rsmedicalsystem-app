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
class MedicalEncounterRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalEncounter';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date_medical_encounter')
                ->minDate(now()->subYears(150))
                ->maxDate(now())
                ->label('Date of Check-up'),

                Grid::make(1)
                ->schema([
                    TextArea::make('chief_complaint')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->label('Chief Complaint'),
                ]),

                Grid::make(2)
                ->schema([
                    TextArea::make('assessment_diagnosis')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->label('Assessment/Diagnosis'),

                    TextArea::make('physical_examination')
                    ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()'])
                    ->label('Physical Examination'),
                ]),

                Grid::make(2)
                ->schema([
                    TextArea::make('treatment_medication')
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

                Grid::make(6)
                ->schema([
                    TextInput::make('temperature')
                    ->label('Temparature (°C)'),

                    TextInput::make('blood_pressure')
                    ->label('Blood Pressure'),

                    TextInput::make('heart_rate')
                    ->label('Heart Rate'),

                    TextInput::make('respiratory_rate')
                    ->label('Respiratory Rate'),

                    TextInput::make('height')
                    ->label('Height(cm)'),

                    TextInput::make('weight')
                    ->label('Weight(kg)'),

                ]),

                
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_medical_encounter')
                ->sortable()
                ->label('Date Check-up'),
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
