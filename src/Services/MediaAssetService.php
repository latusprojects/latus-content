<?php


namespace Latus\Content\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Latus\Content\Models\MediaAsset;
use Latus\Content\Repositories\Contracts\MediaAssetRepository;

class MediaAssetService
{
    public static array $createValidationRules = [
        'is_public' => 'sometimes|boolean',
        'name' => 'required|string|max:255',
        'filename' => 'required|string|max:255',
        'description' => 'sometimes|string',
        'owner_model_class' => 'sometimes|string|max:255',
        'owner_model_id' => 'required_with:owner_model_class|string|max:63',
        'reference' => 'sometimes|string|unique:media_assets,reference|max:255'
    ];

    public function __construct(
        protected MediaAssetRepository $mediaAssetRepository
    )
    {
    }

    public function createAsset(array $attributes): Model
    {
        $validator = Validator::make($attributes, self::$createValidationRules);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->mediaAssetRepository->create($attributes);
    }

    public function deleteAsset(MediaAsset $mediaAsset)
    {
        $this->mediaAssetRepository->delete($mediaAsset);
    }

    public function find(int|string $id): Model|null
    {
        return $this->mediaAssetRepository->find($id);
    }

    public function findByOwnerAndName(string $ownerClass, string $ownerId, string $name): Model|null
    {
        return $this->mediaAssetRepository->findByOwnerAndName($ownerClass, $ownerId, $name);
    }

    public function findByReference(string $reference): Model|null
    {
        return $this->mediaAssetRepository->findByReference($reference);
    }

    public function getOwner(MediaAsset $mediaAsset): Model|null
    {
        return $this->mediaAssetRepository->getOwner($mediaAsset);
    }

    public function setName(MediaAsset $mediaAsset, string $name)
    {
        $this->mediaAssetRepository->setName($mediaAsset, $name);
    }

    public function setOwner(MediaAsset $mediaAsset, string $ownerClass, string $ownerId)
    {
        $this->mediaAssetRepository->setOwner($mediaAsset, $ownerClass, $ownerId);
    }

    public function setReference(MediaAsset $mediaAsset, string $reference)
    {
        $this->mediaAssetRepository->setReference($mediaAsset, $reference);
    }

    public function setDescription(MediaAsset $mediaAsset, string $description)
    {
        $this->mediaAssetRepository->setDescription($mediaAsset, $description);
    }

    public function setIsPublic(MediaAsset $mediaAsset, bool $isPublic)
    {
        $this->mediaAssetRepository->setIsPublic($mediaAsset, $isPublic);
    }

    public function setFilename(MediaAsset $mediaAsset, string $filename)
    {
        $this->mediaAssetRepository->setFilename($mediaAsset, $filename);
    }
}