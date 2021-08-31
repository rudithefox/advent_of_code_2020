defmodule Day1 do
  def part1(year) do
    numbers = File.read!("./list.txt")
    numbers = String.split(numbers, "\n") |> Enum.map(&String.to_integer/1)

    [nums | _rest] = for num1 <- numbers,
    num2 <- numbers,
    num1 + num2 == year do
    [num1 * num2, num1, num2]
    end
    nums
  end
end
