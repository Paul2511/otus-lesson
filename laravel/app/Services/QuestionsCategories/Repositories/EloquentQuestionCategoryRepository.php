<?php


namespace App\Services\QuestionsCategories\Repositories;

use App\Models\QuestionCategory;
use App\Models\Translation;
use App\Services\QuestionsCategories\DTO\DTOInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class EloquentQuestionCategoryRepository
{
    const DEFAULT_PERPAGE = 10;

    public function search(?int $perPage = null, array $with= []): LengthAwarePaginator
    {
        $query = QuestionCategory::query();
        $query->with($with);
        $query->orderByDesc('id');
        return $query->paginate( $perPage ?? static::DEFAULT_PERPAGE );
    }

    public function getCategoriesData(): array
    {
        $data = [
            '' => trans('messages.not_specified')
        ];
        foreach (QuestionCategory::where('parent_id','=',null)->get() as $item){
            $item->getCategoriesTree($data, $item);
        }
        return $data;
    }

    public function createFromDTO(DTOInterface $dto): QuestionCategory
    {
        $data = $dto->toArray();
        return QuestionCategory::create($data);
    }

    public function saveTranslations(QuestionCategory $category, DTOInterface $dto): self
    {
        $data = $dto->toArray();
        $translationModels = [];

        foreach ( Arr::get($data, 'title', []) as $locale => $item) {
            $translationModels[] = new Translation([
                'locale' => $locale,
                'key' => 'title',
                'value' => $item ?? ''
            ]);
        }

        $category->translations()->saveMany($translationModels);
        return $this;
    }

    public function updateFromDTO(QuestionCategory $category, DTOInterface $dto): self
    {
        $data = $dto->toArray();
        $category->update($data);
        return $this;
    }

    public function updateParentCategory(QuestionCategory $category, DTOInterface $dto): self
    {
        $data = $dto->toArray();

        $parentCategory = QuestionCategory::find( Arr::get($data,'parent_id',0) );

        if ($parentCategory !== null) {
            $category->parent()->associate($parentCategory);
        }
        return $this;
    }

    public function updateTitle(QuestionCategory $category, DTOInterface $dto): self
    {
        $data = $dto->toArray();

        $titleRu = Arr::get($data,'title.ru');
        $titleEn = Arr::get($data,'title.en');

        if ( !in_array($titleRu, [null, $category->title('ru')->value]) ) {
            $translation = $category->title('ru');
            $translation->value = $titleRu;
            $translation->save();
        }

        if ( !in_array($titleEn, [null, $category->title('en')->value]) ) {
            $translation = $category->title('en');
            $translation->value = $titleEn;
            $translation->save();
        }

        $category->update($data);

        return $this;
    }

    /**
     * @param QuestionCategory|int $item
     * @throws \Exception
     */
    public function destroy($item): ?bool
    {
        if (!$item instanceof QuestionCategory) {
            $item = QuestionCategory::find( (int) $item);
        }

        if (!$item instanceof QuestionCategory) {
            return false;
        }
        return $item->delete();
    }

}