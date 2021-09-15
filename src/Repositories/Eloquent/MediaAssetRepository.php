<?php


namespace Latus\Content\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;
use Latus\Content\Models\MediaAsset;
use Latus\Content\Repositories\Contracts\MediaAssetRepository as MediaAssetRepositoryContract;
use Latus\Repositories\EloquentRepository;

class MediaAssetRepository extends EloquentRepository implements MediaAssetRepositoryContract
{
    public function relatedModel(): Model
    {
        return new MediaAsset();
    }

    public function delete(MediaAsset $mediaAsset)
    {
        $mediaAsset->delete();
    }

    public function findByOwnerAndName(string $ownerClass, string $ownerId, string $name): Model|null
    {
        return MediaAsset::where('owner_model_class', $ownerClass)->where('owner_model_id', $ownerId)->first();
    }

    public function findByReference(string $reference): Model|null
    {
        return MediaAsset::where('reference', $reference)->first();
    }

    public function getOwner(MediaAsset $mediaAsset): Model|null
    {
        return $mediaAsset->owner()->first();
    }

    public function setName(MediaAsset $mediaAsset, string $name)
    {
        $mediaAsset->name = $name;
        $mediaAsset->save();
    }

    public function setOwner(MediaAsset $mediaAsset, string $ownerClass, string $ownerId)
    {
        $mediaAsset->owner_model_class = $ownerClass;
        $mediaAsset->owner_model_id = $ownerId;
        $mediaAsset->save();
    }

    public function setReference(MediaAsset $mediaAsset, string $reference)
    {
        $mediaAsset->reference = $reference;
        $mediaAsset->save();
    }

    public function setDescription(MediaAsset $mediaAsset, string $description)
    {
        $mediaAsset->description = $description;
        $mediaAsset->save();
    }

    public function setIsPublic(MediaAsset $mediaAsset, bool $isPublic)
    {
        $mediaAsset->is_public = $isPublic ? 1 : 0;
        $mediaAsset->save();
    }

    public function setFilename(MediaAsset $mediaAsset, string $filename)
    {
        $mediaAsset->filename = $filename;
        $mediaAsset->save();
    }
}