<?php


namespace Latus\Content\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Latus\Content\Models\Content;
use Latus\Content\Repositories\Contracts\ContentRepository;

class ContentService
{

    public static array $create_validation_rules = [
        'type' => 'required|string|min:3',
        'name' => 'required|string|min:3|unique:contents',
        'owner_model_class' => 'required|string|min:5',
        'owner_model_id' => 'required|integer|min:0',
        'title' => 'sometimes|string|nullable',
        'text' => 'required|string'
    ];

    public function __construct(
        protected ContentRepository $contentRepository
    )
    {
    }

    public function createContent(array $attributes): Model
    {
        $validator = Validator::make($attributes, self::$create_validation_rules);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->contentRepository->create($attributes);
    }

    public function deleteContent(Content $content)
    {
        $this->contentRepository->delete($content);
    }

    public function findByOwner(string $ownerClass, string $ownerId): Model|null
    {
        return $this->contentRepository->findByOwner($ownerClass, $ownerId);
    }

    public function findByName(string $name): Model|null
    {
        return $this->contentRepository->findByName($name);
    }

    public function getTranslationsOfContent(Content $content): Collection
    {
        return $this->contentRepository->getTranslations($content);
    }

    public function getTranslationOfContent(Content $content, string $language): Model|null
    {
        return $this->contentRepository->getTranslation($content, $language);
    }

    public function setTitleOfContent(Content $content, string|null $title)
    {
        return $this->contentRepository->setTitle($content, $title);
    }

    public function setTextOfContent(Content $content, string $text)
    {
        $this->contentRepository->setText($content, $text);
    }

}