<?php

class Graph
{
    protected array $vertices = [];
    protected array $edges = [];

    public function addVertice(string $vertice): void
    {
        $this->vertices[] = $vertice;
        $this->edges[$vertice] = [];
    }

    public function addEdge(string $verticeOne, string $verticeTwo): void
    { 
        $this->edges[$verticeOne][] = $verticeTwo;
        $this->edges[$verticeTwo][] = $verticeOne;
    }

    public function bfsAlgorithm(string $verticeToStart): array
    {
        $visited = [];
        $route = [];
        $queue = new SplQueue();
        $visited[$verticeToStart] = true;
        $route[] = $verticeToStart;

        $queue->enqueue($verticeToStart);

        while (!$queue->isEmpty()) {
            $vertice = $queue->dequeue();

            foreach ($this->edges[$vertice] as $neighbor) {
                if (!isset($visited[$neighbor])) {
                    $visited[$neighbor] = true;
                    $route[] = $neighbor;
                    $queue->enqueue($neighbor);
                }
            }
        }

        return $route;
    }
}

$graph = new Graph();

$graph->addVertice('A');
$graph->addVertice('B');
$graph->addVertice('C');
$graph->addVertice('D');
$graph->addVertice('E');

$graph->addEdge('A', 'B');
$graph->addEdge('B', 'C');
$graph->addEdge('B', 'D');
$graph->addEdge('C', 'E');

$vert = 'E';
$route = $graph->bfsAlgorithm($vert);
echo "A partir do vertice $vert : " . json_encode($route) . PHP_EOL;