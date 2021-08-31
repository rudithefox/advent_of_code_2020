defmodule Passwords do
  def validate do
      File.read!("list.txt")
    |> String.split("\n")
    |> Enum.map(fn(x) -> String.split(x, ":") end)
    |> Enum.filter(fn([x, y]) ->  Passwords.policy_check?([x, y]) == true end)
    |> length()
  end

  def policy_check?([pol, pass]) do
    [num, char] = String.split(pol, " ")
    pass
    |> String.trim(" ")
    |> Passwords.range?(String.split(num, "-"), char)
    end

  def range?(pass, [pos1, pos2], char) do
    String.slice(pass, String.to_integer(pos1)..String.to_integer(pos1)) == char or String.slice(pass, String.to_integer(pos2)..String.to_integer(pos2)) == char
  end
end
