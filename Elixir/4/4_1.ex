defmodule Passports do
  def checker() do
    File.read!("input.txt")
    |> String.split("\n\n")
    |> Enum.map(fn(x) -> String.split(x, "\n") end)
    |> Enum.map(fn(x) -> Enum.map(x, fn(y) -> String.split(y, " ") end)  |> List_mod.conc() end)
    |> Enum.filter(fn(x) -> Passport.verify?(x) == true end)
    |> length()
  end
end

defmodule List_mod do
  def conc([first | rest]) do
    conc(rest, first)
  end

  def conc([first | rest], list) do
    conc(rest, list++first)
  end

  def conc([], list) do
  list
  end
end

defmodule Passport do
  def verify?(passport) do
    case Enum.count(passport) do
      8 -> true
      7 -> !Enum.any?(passport, fn(x) -> String.contains?(x, "cid") end)
      _ -> false
    end
  end
end
