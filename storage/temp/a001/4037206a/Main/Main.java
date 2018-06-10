package combopt;

import java.io.*;
import java.util.LinkedList;
import java.util.List;
import java.util.stream.Collectors;

/**
 * Created by Daniel on 9.4.2017.
 */
public class Main {
    private static int V;
    private static int totalCustomers;
    private static int totalProducts;

    private static int[] lower_bounds;
    private static int[] upper_bounds;

    private static int[] v_min;
    private static int[][] graph;


    private static boolean bfs(int[] parent, int[][] graph, int s, int t) {
        boolean visited[] = new boolean[V];
        LinkedList<Integer> queue = new LinkedList<>();
        queue.add(s);
        visited[s] = true;
        parent[s] = -1;

        while (!queue.isEmpty()) {
            int u = queue.poll();

            for (int v = 0; v < V; v++)
                if (!visited[v] && graph[u][v] > 0) {
                    queue.add(v);
                    parent[v] = u;
                    visited[v] = true;
                }

        }
        return visited[t];
    }


    public static void fordFulkerson() {
        int u, v;

        int[] parent = new int[V];

        int s = 0, t = V - 1;

        int rGraph[][] = new int[V][V];

        for (u = 0; u < V; u++)
            for (v = 0; v < V; v++)
                rGraph[u][v] = graph[u][v];

        while (bfs(parent, rGraph, s, t)) {
            int path_flow = Integer.MAX_VALUE;
            for (v = t; v != s; v = parent[v]) {
                u = parent[v];
                path_flow = Math.min(path_flow, rGraph[u][v]);
            }

            for (v = t; v != s; v = parent[v]) {
                u = parent[v];
                rGraph[u][v] -= path_flow;
                rGraph[v][u] += path_flow;
            }
        }

        graph = rGraph.clone();

    }


    private static boolean feasible() {
        int[] c = new int[totalCustomers];

        for (int i = 0; i < totalProducts; i++)
            for (int j = 0; j < totalCustomers; j++)
                c[j] += graph[i + totalCustomers + 1][j + 1];

        int[] p = new int[totalProducts];
        for (int i = 0; i < totalProducts; i++)
            for (int j = 0; j < totalCustomers; j++)
                p[i] += graph[i + totalCustomers + 1][j + 1];

        for (int i = 0; i < totalCustomers; i++) {
            if (lower_bounds[i] > c[i] || upper_bounds[i] < c[i])
                return false;
        }

        for (int i = 0; i < totalProducts; i++) {
            if (v_min[i] > p[i] || p[i] > totalCustomers)
                return false;
        }
        return true;
    }


    public static void main(String[] args) {
        String inputFile, outputFile;
        inputFile = args[0];
        outputFile = args[1];
        int[][] new_graph;

        int i, j;

        try {
            BufferedReader bf = new BufferedReader(new FileReader(inputFile));

            List<String> lines = bf.lines().collect(Collectors.toList());

            int index = 0;
            String[] total = lines.get(index++).split(" ");
            totalCustomers = Integer.parseInt(total[0]);
            totalProducts = Integer.parseInt(total[1]);

            V = totalProducts + totalCustomers + 2;

            lower_bounds = new int[totalCustomers];
            upper_bounds = new int[totalCustomers];

            int[][] c_graph = new int[totalCustomers][totalProducts];

            for (i = 0; i < totalCustomers; i++) {
                String[] subS = lines.get(index++).split(" ");
                lower_bounds[i] = Integer.parseInt(subS[0]);
                upper_bounds[i] = Integer.parseInt(subS[1]);

                for (j = 2; j < subS.length; j++)
                    c_graph[i][Integer.parseInt(subS[j]) - 1] = 1;

            }

            v_min = new int[totalProducts];
            j = 0;
            for (String s : lines.get(index).split(" "))
                v_min[j++] = Integer.parseInt(s);

            bf.close();

            graph = new int[V][V];

            for (i = 0; i < totalCustomers; i++)
                graph[0][i + 1] = upper_bounds[i] - lower_bounds[i];

            for (i = 0; i < totalCustomers; i++)
                for (j = 0; j < totalProducts; j++)
                    graph[i + 1][j + totalCustomers + 1] = c_graph[i][j];

            for (i = totalCustomers + 1; i < V - 1; i++)
                graph[i][V - 1] = totalCustomers - v_min[i - (totalCustomers + 1)];

        } catch (IOException e) {
            e.printStackTrace();
        }



        int[] balance = new int[V];
        int index = 1;

        for ( i = 0; i < lower_bounds.length; i++){
            balance[0] -= lower_bounds[i];
            balance[index++] = lower_bounds[i];
        }

        for ( i = 0; i < v_min.length; i++){
            balance[V - 1] += v_min[i];
            balance[index++] = -v_min[i];
        }

        graph[V - 1][0] = Integer.MAX_VALUE;

        V += 2;
        int[][] newG = new int[V][V];

        for (i = 1; i < V - 1; i++)
            for (j = 1; j < V - 1; j++)
                newG[i][j] = graph[i - 1][j - 1];

        for (i = 0; i < balance.length; i++) {
            if (balance[i] > 0) {
                newG[0][i + 1] = balance[i];
            }
            if (balance[i] < 0) {
                newG[i + 1][V - 1] = -balance[i];
            }
        }

        graph = newG.clone();

        fordFulkerson();


        // remove edges
        V -= 2;
        new_graph = new int[V][V];

        for (i = 0; i < V; i++)
            for (j = 0; j < V; j++)
                new_graph[i][j] = graph[i + 1][j + 1];

        new_graph[V - 1][0] = 0;
        graph = new_graph.clone();


        fordFulkerson();


        try {
            BufferedWriter bw = new BufferedWriter(new FileWriter(outputFile));
            if (feasible()) {
                for (i = 1; i < totalCustomers + 1; i++) {
                    for (j = totalCustomers + 1; j < V - 1; j++)
                        if (graph[j][i] > 0) {
                            bw.write((j - totalCustomers) + " ");
                        }
                    bw.newLine();
                }
            } else {
                bw.write("-1");
            }
            bw.close();
        } catch (IOException e) {
            e.printStackTrace();
        }

    }

}