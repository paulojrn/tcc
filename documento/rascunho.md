# 1. Introdução

Novos produtos baseados em software devem superar uma desvantajosa estatística. Aproximadamente 70% (STEVBROS) dos produtos de software falharão, e a razão é uma pobre engenharia de requisitos -- a prática de coleta de requisitos de um sistema a partir de usuários, clientes e outros stakeholders (CHEMUTURI, 2012). Nesse contexto, uma eficiente coleta de requisitos é necessária para minimizar esses problemas que tem consequencias drásticas em desenvolvimento de software.

Um caso de uso representa todos os modos de se usar um sistema para atingir os objetivos específicos de um usuário específico (JACOBSON, 2011). O conjunto de todos os casos de uso fornece todas as maneiras úteis de se usar o sistema e ilustra o valor que esse sistema fornecerá. Uma modernização dessa abordagem, chamada de caso de uso 2.0 é uma prática escalável, ágil que usa casos de uso para capturar um conjunto de requisitos e guiar o desenvolvimento incremental do sistema (JACOBSON, 2011).

Jacobson (2011) sugere 6 princípios para a aplicação de casos de uso com sucesso:

1. Simplificar através de estórias;
2. Conhecer o todo;
3. Foco no valor;
4. Construir o sistema em fatias (*slices* em inglês);
5. Entregar o sistema em incrementos; e
6. Adaptar para se enquadrar nas necessidades da equipe.

# 2. Fundamentação Teórica

Este capítulo apresenta os fundamentos dos tópicos essenciais para a compreenção deste trabalho de conclusão de curso. A sessão seguinte detalha os principais tópicos sobre o histórico e uso de casos de uso. Nesse contexto, é especificado uma outra visão sobre casos de uso, denominada use *case 2.0*, descrita na sessão 2.2. A sessão 2.3 Kanban desecreve a origem e prática de uma estratégia ágil para gerenciamento de projetos. Concluindo este capítulo, a sessão 2.4. Ferramentas de planejamento, monitoração e controle apresenta um sumário sobre ferramentas que representam a infra-estrutura tecnológica para a prática do Kanban e caso de uso em ambientes modernos de desenvolvimento.

## 2.1. Use case

Requisitos de software pode ser definido de duas formas (POHL, 2016): Uma condição ou capacidade de um usuário resolver um problema ou alcançar um objetivo; ou uma condição ou capacidade que precisa ser atingida, ou possuída, por um sistema (ou módulo do sistema), para satisfazer um contrato, padrão, especificação ou outro documento formal.
Nesse contexto, o processo de engenharia de requisitos é composto de 4 atividades fundamentais  (POHL, 2016): 

1. Licitação: Diferentes técnicas usadas para obter os requisitos de stakeholders e outras fontes para refinar os requisitos.
2. Documentação: Descrição adequada dos requisitos obtidos na atividade de licitação. Diferentes técnicas podem ser usadas para documentar os requisitos, usando linguagem natural ou modelos conceituais.
3. Validação e negociação: Para garantir coerência, os requisitos devem ser validados pelos stakeholders.
4. Gerenciamento de requisitos: Atividades necessárias para estruturar requisitos, prepara-los para que possam ser compreendidos por diferentes pessoas com diferentes responsabilidades, e principalmente manter consistência depois de mudanças para garantir a implementação adequada.

Requisitos de software licitados podem ser documentados de diversas formas, como histórias de usuário ou casos de uso por exemplo (WIEGERS, BEATTY, 2013). Nesse cenário, uma técnica importante para a análise de requisitos que tem sido largamente aplicada no desenvolvimento de software, é a análise de casos de uso. Um caso de uso é definido como uma lista de ações ou etapas que definem as interações entre um ator -- papel que representa um usuário humano ou outro sistema externo que interage com o sistema (OMG, 2017) -- e o sistema, para atingir um objetivo específico (JACOBSON et al., 1992). Logo, a análise de casos de uso usa-se de casos de uso para identificar requisitos de um sistema para o desenvolvimento de um sistema de software.

Atualmente não há um consenso da comunidade acadêmica e indústria para o formato correto do uso dos casos de uso. Cockburn, 1999 afirma que casos de uso são meramente formas de se escrever requisitos. Consequentemente, diferentes propósitos acarretam em diferentes modelos. Classicamente um caso de uso deve descrever um fluxo principal de atividades de um ator, baseado em um conjunto de premissas, possíveis fluxos alternativos e pós-condições esperadas após a conclusão do caso de uso (COCKBURN, 1999). Uma ferramenta gráfica para ilustrar casos de uso é o diagrama UML de casos de uso. Nesse diagrama, um ator é relacionado a um conjunto de casos de uso (Figura 1).

[incluir figura 1]

Este diagrama pode incluir ainda mais informação sobre o caso de uso com o uso de anotações UML. Por exemplo, a figura 1 mostra a anotação *include*, que implica que o caso de uso X e Y tem um fluxo de atividades em comum, que é representado no caso de uso Z. Da mesma maneira, há uma fluxo de atividades opcional em X, que é representado no caso de uso W.

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

[incluir figura 1]

Interpretando o quadro, pode-se notar que as tarefas x, y e z estão definidas mas o seu desenvolvimento ainda não começou. As tarefas i e j estão em desenvolvimento, as tarefas k e l estão prontas para revisão, w e s estão sendo revisadas e p, q, r estão prontas para serem empacotadas e entregues para o cliente. Nota-se que na coluna "Trabalho em andamento" há uma limitação de cartões. Assim é possível que uma terceira tarefa seja desenvolvida paralelamente a i e j, contudo não é possível começar uma quarta tarefa enquanto as três primeiras não sejam terminadas.

## 2.4. Ferramentas de planejamento, monitoramento e controle.

Ferramentas como quadro kanban auxilia na visualização do fluxo de trabalho, contudo há a desvantagem do uso do espaço físico. Considerando membros da mesma equipe geograficamente disperços, há uma dificuldade em se manter a paridade entre quadros kanban diferentes. Outra desvantagem de se utilizar meios físicos é a dificuldade de manter um histórico completo (necessário para resgatar pacotes de trabalho já terminados) e backup em caso de sinistros (como uma faxineira insandecida motivada pelo desejo de limpar uma parede coberta de papeis). Com o objetivo de resolver estes problemas, atualmente há uma demanda para ferramentas automatizadas de planejamento, monitoração e controle.

Uma dessas ferramentas é o Kanboard (https://kanboard.net/). O foco em simplicidade e minimalismo pode dar uma aparência amadora para esta ferramenta web, porém suas funcionalidades revelam um sistema poderoso e estável. A última versão (até esta data) da ferramenta, 1.0.46 permite a visualização objetiva das tarefas, facilidade em arrastar tarefas entre colunas, busca, diferentes formas de visualização, ações automáticas, gráficos de Gantt, relatórios de produtividade além de integrações com várias ferramentas, backend de autenticação múltipla e internacionalização para 26 idiomas.

A Figura 2 apresenta o mesmo quadro kanban da Figura 1, porém usando o Kanboard. Nota-se que não há perda de informações; pelo contrário, o uso do Kanboard permite que seja visualizado várias informações como prioridade, complexidade, prazo com mais clareza.

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
* POHL, Klaus. Requirements engineering fundamentals: a study guide for the certified professional for requirements engineering exam-foundation level-IREB compliant. Rocky Nook, Inc., 2016.
* WIEGERS, Karl; BEATTY, Joy. Software requirements. Pearson Education, 2013.
* https://kanboard.net/
* http://stevbros.com/blog/80-new-products-fail-70-of-software-projects-fail-due-to-poor-requirements.html
* Chemuturi, Murali. Requirements engineering and management for software development projects. Springer Science & Business Media, 2012.
* USE-CASE 2.0 The Guide to Succeeding with Use Cases Ivar Jacobson, 2011