<?php

namespace App\Service\ControllerService;

use App\Entity\Tag;
use App\Form\TagFormType;
use App\Repository\TagRepository;
use App\Service\Abstract\AbstractCrudService;
use App\Service\Interface\CrudServiceInterface;
use App\Utils\Filter\Column;
use App\Utils\Filter\QueryParser;
use App\Utils\RequestUtils;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class TagService extends AbstractCrudService implements CrudServiceInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private TagRepository $repository
    ) {
        $queryParser = new QueryParser();
        $queryParser->setColumns([
            new Column([
                'name' => 'id',
                'label' => 'Дата добавления',
                'type' => Column::NOT_FILTERABLE_TYPE,
                'isOrderable' => true,
                'isSearchable' => false,
            ]),
            new Column([
                'name' => 'name',
                'label' => 'Название',
                'type' => Column::STRING_TYPE,
                'isOrderable' => true,
                'isSearchable' => true,
            ]),
        ]);

        $this->setQueryParser($queryParser)->setRepository($repository);
    }

    public function create(Request $request): array
    {
        $tag = new Tag();
        $form = $this->formFactory->create(TagFormType::class, $tag);
        RequestUtils::submitForm($request, $form, true);

        $this->getRepository()->save($tag, true);

        return $tag->format();
    }

    public function update(Request $request, int $id): array
    {
        $tag = $this->find($id);
        $form = $this->formFactory->create(TagFormType::class, $tag, [
            'method' => 'PATCH',
        ]);

        RequestUtils::submitForm($request, $form, false);

        $this->getRepository()->save($tag, true);

        return $tag->format();
    }
}
