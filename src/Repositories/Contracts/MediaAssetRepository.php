<?php


namespace Latus\Content\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;
use Latus\Content\Models\MediaAsset;
use Latus\Repositories\Contracts\Repository;

interface MediaAssetRepository extends Repository
{
    public function delete(MediaAsset $mediaAsset);

    public function findByOwnerAndName(string $ownerClass, string $ownerId, string $name): Model|null;

    public function findByReference(string $reference): Model|null;

    public function getOwner(MediaAsset $mediaAsset): Model|null;

    public function setName(MediaAsset $mediaAsset, string $name);

    public function setOwner(MediaAsset $mediaAsset, string $ownerClass, string $ownerId);

    public function setReference(MediaAsset $mediaAsset, string $reference);

    public function setDescription(MediaAsset $mediaAsset, string $description);

    public function setIsPublic(MediaAsset $mediaAsset, bool $isPublic);

    public function setFilename(MediaAsset $mediaAsset, string $filename);

}