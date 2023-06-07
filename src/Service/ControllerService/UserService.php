<?php

namespace App\Service\ControllerService;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use App\Service\Abstract\AbstractCrudService;
use App\Service\Interface\CrudServiceInterface;
use App\Utils\Filter\Column;
use App\Utils\Filter\QueryParser;
use App\Utils\ImageSaver;
use App\Utils\RequestUtils;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class UserService extends AbstractCrudService implements CrudServiceInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private string $dirPublic,
        private string $dirUserUploads,
        private UserRepository $repository
    ) {
        $queryParser = new QueryParser();
        $queryParser->setColumns([
            new Column([
                'name' => 'id',
                'label' => 'Дата добавления',
                'type' => Column::NOT_FILTERABLE_TYPE,
                'isOrderable' => true,
                'isFilterable' => false,
                'isSearchable' => false,
            ]),
            new Column([
                'name' => 'firstName',
                'label' => 'Имя',
                'type' => Column::STRING_TYPE,
                'isOrderable' => true,
                'isSearchable' => true,
            ]),
            new Column([
                'name' => 'lastName',
                'label' => 'Фамилия',
                'type' => Column::STRING_TYPE,
                'isOrderable' => true,
                'isSearchable' => true,
            ]),
            new Column([
                'name' => 'middleName',
                'label' => 'Отчество',
                'type' => Column::STRING_TYPE,
                'isOrderable' => true,
                'isSearchable' => true,
            ]),
            new Column([
                'name' => 'email',
                'label' => 'Email',
                'type' => Column::STRING_TYPE,
                'isOrderable' => true,
                'isSearchable' => true,
            ]),
            new Column([
                'name' => 'roles',
                'label' => 'Роли',
                'type' => Column::ARRAY_TYPE,
                'isOrderable' => true,
                'isSearchable' => true,
            ]),
            new Column([
                'name' => 'isActive',
                'label' => 'Активен',
                'type' => Column::BOOLEAN_TYPE,
                'isOrderable' => true,
                'isSearchable' => false,
            ]),
        ]);

        $this->setQueryParser($queryParser)->setRepository($repository);
    }

    public function create(Request $request): array
    {
        $user = new User();
        $form = $this->formFactory->create(UserFormType::class, $user);
        RequestUtils::submitForm($request, $form, true);

        if ($image = $form['image']->getData()) {
            $filename = (new ImageSaver())->save(
                $image,
                $this->dirPublic,
                $this->dirUserUploads,
                'user',
            );

            $user->setImagePath($filename);
        }

        $this->getRepository()->save($user, true);

        return $user->format();
    }

    public function update(Request $request, int $id): array
    {
        /** @var User $user */
        $user = $this->find($id);
        $form = $this->formFactory->create(UserFormType::class, $user, [
            'method' => 'PATCH',
        ]);

        RequestUtils::submitForm($request, $form, false);

        if ($image = $form['image']->getData()) {
            $filename = (new ImageSaver())->save(
                $image,
                $this->dirPublic,
                $this->dirUserUploads,
                'user',
            );

            $user->setImagePath($filename);
        }

        $user->setIsActive(false);
        $this->getRepository()->save($user, true);

        return $user->format();
    }
}
