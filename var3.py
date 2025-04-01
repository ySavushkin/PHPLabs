import random


#Дaна целочисленная прямоугольная матрица. Определить:
#1) количество строк, содержащих хотя бы один нулевой элемент;
#2) номер столбца, в котором находится самая длинная серия одинаковых элементов


def generate_matrix(rows, cols):
    return [[random.randint(0, 9) for _ in range(cols)] for _ in range(rows)]


def count_rows_with_zero(matrix):
    count = 0
    for row in matrix:
        if 0 in row:
            count += 1
    return count


def longest_series_column(matrix):
    longest_series_length = 0
    longest_series_column_index = 0

    for j in range(len(matrix[0])):
        series_length = 1
        for i in range(1, len(matrix)):
            if matrix[i][j] == matrix[i - 1][j]:
                series_length += 1
                if series_length > longest_series_length:
                    longest_series_length = series_length
                    longest_series_column_index = j
            else:
                series_length = 1

    return longest_series_column_index


rows = 5
cols = 5
matrix = generate_matrix(rows, cols)

rows_with_zero_count = count_rows_with_zero(matrix)
longest_series_column_index = longest_series_column(matrix)

print("Сгенерированная матрица:")
for row in matrix:
    print(row)

print("\nКоличество строк, содержащих хотя бы один нулевой элемент:", rows_with_zero_count)
print("Номер столбца, в котором находится самая длинная серия одинаковых элементов:", longest_series_column_index+1)
