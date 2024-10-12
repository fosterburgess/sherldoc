<?php

namespace App\Filament\Resources;

use App\Actions\DocumentEmbed;
use App\Actions\ExtractTextFromDocument;
use App\Actions\SummarizeDocContents;
use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('document')
                    ->visible(fn($record) => !$record?->id)
                    ->maxSize(125 * 1024 * 1024)
                    ->storeFileNamesIn('original_name')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),

                Forms\Components\TextInput::make('name')
                    ->columnSpanFull()
                    ->readOnly(),
                Textarea::make('summary')
                    ->rows(8)
                    ->columnSpanFull()
                    ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('extract')
                    ->label('Extract')
                    ->icon('heroicon-o-document-text')
                    ->action(fn ($record) =>app(ExtractTextFromDocument::class)($record)),
                Tables\Actions\Action::make('embed')
                    ->label('Embed')
                    ->icon('heroicon-o-document-text')
                    ->action(fn ($record) =>app(DocumentEmbed::class)($record)),
                Tables\Actions\Action::make('summarize')
                    ->label('Summarize')
                    ->icon('heroicon-o-document-text')
                    ->action(fn ($record) =>app(SummarizeDocContents::class)($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
