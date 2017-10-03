# 1. Introdução

# 2. Fundamentação Teórica

Este capítulo apresenta os fundamentos dos tópicos essenciais para a compreenção deste trabalho de conclusão de curso. A sessão seguinte detalha os principais tópicos sobre o histórico e uso do diagrama UML de casos de uso. Nesse contexto, é especificado uma outra visão sobre casos de uso, denominada use *case 2.0*, descrita na sessão 2.2. A sessão 2.3 Kanban desecreve a origem e prática de uma estratégia ágil para gerenciamento de projetos. Concluindo este capítulo, a sessão 2.4. Ferramentas de planejamento, monitoração e controle apresenta um sumário sobre ferramentas que representam a infra-estrutura tecnológica para a prática do Kanban e caso de uso em ambientes modernos de desenvolvimento.

## 2.1. Use case

**Explicar processo de engenharia de software**

Nesse contexto, uma técnica importante para a análise de requisitos que tem sido largamente aplicada no desenvolvimento de software, é a análise de casos de uso. Um caso de uso é definido como uma lista de ações ou etapas que definem as interações entre um ator -- papel que representa um usuário humano ou outro sistema externo que interage com o sistema (OMG, 2017) -- e o sistema, para atingir um objetivo específico (JACOBSON et al., 1992). Logo, a análise de casos de uso usa-se de casos de uso para identificar requisitos de um sistema para o desenvolvimento de um sistema de software.

Atualmente não há um consenso da comunidade acadêmica e indústria para o formato correto do uso dos casos de uso. Cockburn, 1999 afirma que casos de uso são meramente formas de se escrever requisitos. Consequentemente, diferentes propósitos acarretam em diferentes modelos.

## 2.2. Use Case 2.0

- histórico
- detalhamento
- principais mudanças
- slice

## 2.3. Kanban

No ano de 1991, o termo desenvolvimento agil de software foi popularizado pelo Manifesto Ágil (http://agilemanifesto.org/). Este manifesto definia formalmente princípios e valores que alteram drasticamente a abordagem clássica e preditiva de desenvolvimento de software, usado por exemplo no modelo Waterfall (BOEHM, 1988). Devido a natureza inerentemente interativa, incremental e evolucionária, casos de uso se enquadram perfeitamente no contexto de desenvolvimento ágil de software.

A metodologia de visualização de fluxo de trabalho Kanban foi adaptada da manufatura enxuta utilizado pela compania japonesa Toyota (SUGIMORI, et al., 1977). Um indicador de sucesso nos anos 70 no Japão no contexto da produção baseado em demanda é a habilidade de prever a demanda. Nesse contexto o toyotismo inovou com o kanban era utilizar a demanda real observada (OHNO, 1988). 

No contexto de desenvolvimento de software kanban é uma abordagem que usa um quadro kanban para visualizar tarefas. Dessa forma melhora-se a compreensão do trabalho e fluxo de trabalho. A metodologia kanban também sugere a lmitação no progresso de trabalho, assim reduz disperdício de tempo e esforço devido a multitarefas e mudanças de contexto e expõe problemas operacionais e estmila a colaboração para melhorar o sistema (BOEG, 2012). O kanban é embasado em dois conjuntos de princípios, para mudanças de gerenciamento e fornecimentos de servicos, que da enfaze em mudanças evolucionárias e foco no cliente. O método não sugere um número de passos ou procedimentos, contudo estimunla mudanças contínuas, incrementais e evolucionárias no sistema. Assim um dos objetivos do kanban é minimizar resistência à mudança e facilita-la (BOEG, 2012).

Para focar no cliente e trabalho que atinge as necessidades do cliente, invés de atividades de desenvolvedores, o kanban define seis práticas gerais:

* Visualização do trabalho;
* Limitação do trbalho em andamento;
* Gerenciamento de fluxo de trabalho;
* Explicitar politicas;
* Ciclos de feedback, e
* Evolução experimental.

A operacionalização desses conceitos é atingido por intermédio de um quadro kanban (tradução livre do termo kanban board). Esse quadro exibe um conjunto de cartões que desecrevem uma tarefa a ser resolvida. Esses cartões são organizados no quadro por colunas: uma coluna representa o estado que a tarefa se encontra. Por exemplo, o quadro kanban ilustrado na Figura 1 apresenta x tickets organizados em y colunas.

[incluir imagem 1]

Interpretando o quadro, pode-se notar que as tarefas x, y e z estão definidas mas o seu desenvolvimento ainda não começou. As tarefas i e j estão em desenvolvimento, as tarefas k e l estão prontas para revisão, w e s estão sendo revisadas e p, q, r estão prontas para serem empacotadas e entregues para o cliente. Nota-se que na coluna "Trabalho em andamento" há uma limitação de cartões. Assim é possível que uma terceira tarefa seja desenvolvida paralelamente a i e j, contudo não é possível começar uma quarta tarefa enquanto as três primeiras não sejam terminadas.

## 2.4. Ferramentas de planejamento monitoramento e controle.



---
# Citações
* Jacobson Ivar, Christerson Magnus, Jonsson Patrik, Övergaard Gunnar, Object-Oriented Software Engineering - A Use Case Driven Approach, Addison-Wesley, 1992.
* OMG Unified Modeling Language (OMG UML), Superstructure, V2.1.2, pp. 586–588
* Writing Effective Use Cases, 1999d
* http://agilemanifesto.org/
* BOEHM, Barry W.. . A spiral model of software development and enhancement. Computer, v. 21, n. 5, p. 61-72, 1988.
* SUGIMORI, Y. et al. Toyota production system and kanban system materialization of just-in-time and respect-for-human system. The International Journal of Production Research, v. 15, n. 6, p. 553-564, 1977.
* OHNO, Taiichi. Toyota production system: beyond large-scale production. crc Press, 1988.
* BOEG, Jesper. Priming Kanban. InfoQ/Trifork,, 2012.