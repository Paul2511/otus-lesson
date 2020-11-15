<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\DocumentService
 *
 * @property int $id
 * @property int $document_id
 * @property string $service_uuid
 * @method static Builder|DocumentService newModelQuery()
 * @method static Builder|DocumentService newQuery()
 * @method static Builder|DocumentService query()
 * @method static Builder|DocumentService where1cServiceUuid($value)
 * @method static Builder|DocumentService whereDocumentId($value)
 * @method static Builder|DocumentService whereId($value)
 * @mixin \Eloquent
 */
class DocumentService extends Pivot
{

}
