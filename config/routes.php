<?php

use Alura\Cursos\Controller\CursosEmJson;
use Alura\Cursos\Controller\CursosEmXml;
use Alura\Cursos\Controller\Deslogar;
use Alura\Cursos\Controller\Exclusao;
use Alura\Cursos\Controller\ExclusaoDeFormacao;
use Alura\Cursos\Controller\FormularioEdicao;
use Alura\Cursos\Controller\FormularioFormacao;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\FormularioLogin;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\ListarFormacoes;
use Alura\Cursos\Controller\Persistencia;
use Alura\Cursos\Controller\PersistenciaFormacao;
use Alura\Cursos\Controller\RealizarLogin;

return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/alterar-curso' => FormularioEdicao::class,
    '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Deslogar::class,
    '/CursosEmJson' => CursosEmJson::class,
    '/BuscarCursosEmXml' => CursosEmXml::class,
    '/nova-formacao' => FormularioFormacao::class,
    '/salvar-formacao' => PersistenciaFormacao::class,
    '/listar-formacoes' => ListarFormacoes::class,
    '/excluir-formacao' => ExclusaoDeFormacao::class,
];
