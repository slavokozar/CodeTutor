#!/usr/bin/env python3
import math
from collections import OrderedDict
from copy import deepcopy
import sys


class Graph:

    def __init__(self):
        self._nodes = OrderedDict()
        self._edges = []

    def nodes(self):
        return list(self._nodes.values())

    def edges(self):
        return list(self._edges)

    def add_node(self, name, data=None):
        if self.has_node(name):
            raise ValueError("Node %s already exists" % name)
        self._nodes[name] = Node(name, data)
        return self._nodes[name]

    def remove_node(self, n):
        node = self._node_lookup([n])
        # remove all edges to/from the node first
        for edge in self.edges():
            if node in edge.nodes():
                self.remove_edge(edge)
        del self._nodes[node.name()]

    def add_edge(self, src, dst, data=None):
        srcnode, dstnode = self._node_lookup([src, dst])
        if srcnode is None or dstnode is None:
            raise ValueError("No such node in this graph")
        edge = Edge(srcnode, dstnode, data)
        self._edges.append(edge)
        return edge

    def remove_edge(self, edge):
        if not edge in self._edges:
            return
        self._edges.remove(edge)

    def get_node(self, name):
        return self._nodes.get(name)

    def has_node(self, name):
        return name in self._nodes

    def get_edge(self, n1, n2):
        src, dst = self._node_lookup([n1, n2])
        if src is None or dst is None:
            raise ValueError("No such node in this graph")
        return src.edge_to(dst)

    def has_edge(self, n1, n2):
        return self.get_edge(n1, n2) is not None

    def _node_lookup(self, l):
        res = []
        for obj in l:
            if obj in self.nodes():
                res.append(obj)
            else:
                res.append(self._nodes.get(obj))

        return res if not len(res) == 1 else res[0]

    def __str__(self):
        res = "Nodes:\n"
        for node in self._nodes.values():
            res += str(node)

        res += "Edges:\n"
        for edge in self._edges:
            res += str(edge)

        return res


class Node:

    def __init__(self, name, data=None):
        self._name = name
        if data is not None:
            for key, value in data.items():
                setattr(self, key, value)

    def name(self):
        return self._name

    def __str__(self):
        res = self._name + "\n"
        for key, value in vars(self).items():
            if not key.startswith("_"):
                res += "    " + str(key) + " : " + str(value) + "\n"

        return res


class Edge:

    def __init__(self, node1, node2, data=None):
        self._node1 = node1
        self._node2 = node2
        if data is not None:
            for key, value in data.items():
                setattr(self, key, value)

    def source(self):
        return self._node1

    def destination(self):
        return self._node2

    def set_source(self, node):
        self._node1 = node

    def set_destination(self, node):
        self._node2 = node

    def __str__(self):
        res = self._node1.name() + " --> " + self._node2.name() + "\n"
        for key, value in vars(self).items():
            if not key.startswith("_"):
                res += "    " + str(key) + " : " + str(value) + "\n"

        return res


def bellman_ford_cycle(graph):
    for node in graph.nodes():
        node.dist = sys.maxsize
        node.predecessor = None

    GS_node = graph.get_node('GS')
    GS_node.dist = 0

    for i in range(len(graph.nodes()) - 1):
        for edge in graph.edges():
            if edge.source().dist + edge.cost < edge.destination().dist:
                edge.destination().dist = edge.source().dist + edge.cost
                edge.destination().predecessor = edge.source()

    cycle = []
    for edge in graph.edges():
        if edge.source().dist + edge.cost < edge.destination().dist:

            cycle.append(edge.destination())
            cycle.append(edge.source())
            edge_from = edge.source()
            while edge_from.predecessor not in cycle:
                cycle.append(edge_from.predecessor)
                edge_from = edge_from.predecessor
            cycle.append(edge_from.predecessor)
            break

    for node in graph.nodes():
        del node.dist
        del node.predecessor

    return cycle


def _build_residual_graph(graph):
    res = deepcopy(graph)

    for edge in res.edges():
        if edge.upper - edge.flow != 0:
            edge.upper = edge.upper - edge.flow

        if edge.flow - edge.lower != 0:
            edge.upper = edge.flow - edge.lower
            edge.cost = -edge.cost
            src = edge.source()
            edge.set_source(edge.destination())
            edge.set_destination(src)

    return res


def solve_min_cost_flow(graph, players):
    res_graph = _build_residual_graph(graph)

    res_graph.add_node('GS')

    for i in range(players * 2):
        res_graph.add_edge('GS', str(i), {
            "lower": 0,
            "flow": 0,
            "upper": 1,
            "cost": 0
        })

    flow_array = [[0 for j in range(players * 2)] for i in range(players * 2)]
    for i in range(players):
        flow_array[i][i + players] = 1

    repeat = True
    while repeat:
        neg_cycle = bellman_ford_cycle(res_graph)
        visited = []

        if len(neg_cycle) > 0:

            stop_while = False

            stack_edge_from = neg_cycle.pop().name()
            visited.append(stack_edge_from)
            stack_edge_to = neg_cycle.pop().name()
            visited.append(stack_edge_to)

            while True:

                found_cost = 0
                forward = False

                for edge in graph.edges():
                    if stack_edge_from == edge.source().name() and stack_edge_to == edge.destination().name():
                        forward = True
                        found_cost = edge.cost
                        break
                    if stack_edge_from == edge.destination().name() and stack_edge_to == edge.source().name():
                        forward = False
                        found_cost = edge.cost
                        break

                if forward:
                    for edge in res_graph.edges():
                        if stack_edge_from == edge.source().name() and stack_edge_to == edge.destination().name():
                            flow_array[int(edge.source().name())][int(edge.destination().name())] = 1
                            res_graph.remove_edge(edge)

                            res_graph.add_edge(str(stack_edge_to), str(stack_edge_from), {
                                "lower": 0,
                                "flow": 0,
                                "upper": 1,
                                "cost": -found_cost
                            })
                            break
                else:
                    for edge in res_graph.edges():
                        if stack_edge_from == edge.source().name() and stack_edge_to == edge.destination().name():
                            flow_array[int(edge.destination().name())][int(edge.source().name())] = 0
                            res_graph.remove_edge(edge)

                            res_graph.add_edge(str(stack_edge_to), str(stack_edge_from), {
                                "lower": 0,
                                "flow": 0,
                                "upper": 1,
                                "cost": found_cost
                            })
                            break

                if stop_while:
                    break

                stack_edge_from = stack_edge_to
                stack_edge_to = neg_cycle.pop().name()

                if stack_edge_to in visited:
                    stop_while = True
                visited.append(stack_edge_from)

        else:
            repeat = False

    return flow_array


def euclid_distance(x1, y1, x2, y2):
    return math.sqrt(pow(x1 - x2, 2) + pow(y1 - y2, 2))


def magic():
    file = open(str(sys.argv[1]), "r")
    output_file = open(str(sys.argv[2]), "w")

    first_line = file.readline()
    players_count = int(first_line.split(' ')[0])
    rows = int(first_line.split(' ')[1])
    players = list(range(players_count))

    for i in range(rows - 1):
        if i == 0:
            first_positions = file.readline()
            second_positions = file.readline()
            players = rework_positions(first_positions, players, players_count, second_positions)
            output_players_positions(players, output_file)

        else:
            first_positions = second_positions
            second_positions = file.readline()
            players = rework_positions(first_positions, players, players_count, second_positions)
            output_players_positions(players, output_file, True if i != rows - 2 else False)


def output_players_positions(players, output_file, not_end=True):
    for index, player in enumerate(players):
        if index != len(players):
            if len(players) - 1 != index:
                print(player + 1, end=' ')
                output_file.write(str(player + 1) + ' ')
            else:
                print(player + 1, end='')
                output_file.write(str(player + 1))
    if not_end:
        print('\n')
        output_file.write('\n')


def rework_positions(first_positions, players, players_count, second_positions):
    g = Graph()
    for p in range(players_count):
        g.add_node(str(p), {
            "x": int(first_positions.split(' ')[p * 2]),
            "y": int(first_positions.split(' ')[p * 2 + 1])
        })
    for p in range(players_count):
        g.add_node(str(p + players_count), {
            "x": int(second_positions.split(' ')[p * 2]),
            "y": int(second_positions.split(' ')[p * 2 + 1])
        })
    for p in range(players_count):
        for q in range(players_count):
            node1 = g.get_node(str(p))
            node2 = g.get_node(str(q + players_count))
            g.add_edge(str(p), str(q + players_count), {
                "lower": 0,
                "flow": 1 if p == q else 0,
                "upper": 1,
                "cost": euclid_distance(node1.x, node1.y, node2.x, node2.y)
            })
    # print(g)
    flow_array = solve_min_cost_flow(g, players_count)
    players_new = players[:]

    build_positions(flow_array, players, players_new)
    return players_new


def build_positions(flow_array, players, players_new):
    for i, row in enumerate(flow_array):
        for j, value in enumerate(row):
            if i >= len(players):
                continue
            else:
                if value == 1:
                    players_new[i] = j - len(players)


def main():
    magic()


if __name__ == "__main__":
    main()
