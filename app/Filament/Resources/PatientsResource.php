<?php

namespace App\Filament\Resources;
use App\Filament\Resources\PatientsResource\Pages;
use App\Filament\Resources\PatientsResource\RelationManagers;
use App\Models\Patients;
use App\Models\Gender;
use App\Models\MedicalHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
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
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Fieldset;
use Illuminate\Database\Eloquent\Model;
class PatientsResource extends Resource
{
    protected static ?string $model = Patients::class;

    protected static ?string $navigationIcon = 'heroicon-m-user-circle';
    protected static ?string $navigationGroup = 'Patient Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Post Details')
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextInput::make('first_name')
                            ->required()
                            ->label('First Name')
                            ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()']),

                            TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()']),

                            TextInput::make('last_name')
                            ->required()
                            ->label('Last Name')
                            ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()']),

                            
                        ]),

                        Grid::make(1)
                        ->schema([
                            TextArea::make('address')
                            ->label('Address')
                            ->extraInputAttributes(['onInput' => 'this.value = this.value.toUpperCase()']),
                        ]),

                        Grid::make(3)
                        ->schema([
                            Select::make('gender_id')
                            ->label('Gender')
                            ->preload()
                            ->options(Gender::pluck('gender_name', 'id'))
                            ->searchable()
                            ->required(),

                            DatePicker::make('birthday')
                            ->minDate(now()->subYears(150))
                            ->maxDate(now())
                            ->required(),

                            TextInput::make('contact_no')
                            ->prefix('+63')
                            ->tel()
                            ->label('Contact No.'),
                        ]),

                        Grid::make(2)
                        ->schema([
                            TextInput::make('height')
                            ->label('Height'),

                            TextInput::make('weight')
                            ->label('Weight'),
                        ])
                    ]),
                    Section::make('Family Background')
                    ->schema([
                        Grid::make(3)
                        ->schema([
                            TextInput::make('fathers_first_name')
                            ->label("Father's First Name"),

                            TextInput::make('fathers_middle_name')
                            ->label("Father's Middle Name"),

                            TextInput::make('fathers_last_name')
                            ->label("Father's Last Name"),
                        ]),

                        Grid::make(2)
                        ->schema([
                            TextInput::make('fathers_fathers_occupation')
                            ->label("Father's Occupation"),

                            TextInput::make('fathers_contact_no')
                            ->prefix('+63')
                            ->tel()
                            ->label("Father's Contact No."),
                        ]),

                        Grid::make(3)
                        ->schema([
                            TextInput::make('mothers_first_name')
                            ->label("Mother's First Name"),

                            TextInput::make('mothers_middle_name')
                            ->label("Mother's Middle Name"),

                            TextInput::make('mothers_last_name')
                            ->label("Mother's Last Name"),
                        ]),

                        Grid::make(2)
                        ->schema([
                            TextInput::make('mothers_fathers_occupation')
                            ->label("Mother's Occupation"),

                            TextInput::make('mothers_contact_no')
                            ->prefix('+63')
                            ->tel()
                            ->label("Mother's Contact No."),

                        ]),

                     ]),
            ]);
    }

    public static function getPatientFormSchema(): array
    {
        return [    
               
                ];
    }

    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('first_name')
                ->searchable()
                ->sortable()
                ->label('First Name'),

                TextColumn::make('middle_name')
                ->searchable()
                ->sortable()
                ->label('Middle Name'),

                TextColumn::make('last_name')
                ->searchable()
                ->sortable()
                ->label('Last Name'),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatients::route('/create'),
            'edit' => Pages\EditPatients::route('/{record}/edit'),
        ];
    }
}
