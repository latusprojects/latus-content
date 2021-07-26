<?php


namespace Latus\Content\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Latus\Content\Models\ContentTranslation;
use Latus\Content\Repositories\Contracts\ContentTranslationRepository;

class ContentTranslationService
{

    public static array $create_validation_rules = [
        'content_id' => 'required|exists:contents',
        'language' => 'required|string|min:2|max:8',
        'title' => 'sometimes|string|nullable',
        'text' => 'required|string'
    ];

    public function __construct(
        protected ContentTranslationRepository $translationRepository
    )
    {
    }

    public function createTranslation(array $attributes): Model
    {
        $validator = Validator::make($attributes, self::$create_validation_rules);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->translationRepository->create($attributes);
    }

    public function deleteTranslation(ContentTranslation $contentTranslation)
    {
        $this->translationRepository->delete($contentTranslation);
    }

    public function getContentOfTranslation(ContentTranslation $contentTranslation): Model
    {
        return $this->translationRepository->getContent($contentTranslation);
    }

    public function setTitleOfTranslation(ContentTranslation $contentTranslation, string|null $title)
    {
        $this->translationRepository->setTitle($contentTranslation, $title);
    }

    public function setTextOfTranslation(ContentTranslation $contentTranslation, string $text)
    {
        $this->translationRepository->setText($contentTranslation, $text);
    }
}