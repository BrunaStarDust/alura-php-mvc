<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Formacao;
use Alura\Cursos\Exceptions\DescricaoInvalidaException;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenciaFormacao implements
    RequestHandlerInterface
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $descricao = filter_var(
            $request->getParsedBody()['descricao'],
            FILTER_SANITIZE_STRING
        );

        $formacao = new Formacao();

        try {
            $formacao->setDescricao($descricao);
        } catch (DescricaoInvalidaException $error) {
            $this->defineMensagem('danger', $error->getMessage());
            return new Response(302, ['Location' => '/nova-formacao']);
        }

        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        if (!is_null($id) && $id !== false) {
            $formacao->setId($id);
            $this->entityManager->merge($formacao);
            $this->defineMensagem('success', 'Formação atualizada com sucesso.');
        } else {
            $this->entityManager->persist($formacao);
            $this->defineMensagem('success', 'Formação inserida com sucesso.');
        }

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/listar-formacoes']);
    }
}
