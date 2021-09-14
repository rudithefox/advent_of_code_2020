defmodule Passports do
  def checker() do
    File.read!("input.txt")
    |> String.split("\n\n")
    |> Enum.map(fn x -> String.split(x, "\n") end)
    |> Enum.map(fn x -> Enum.map(x, fn y -> String.split(y, " ") end) |> List_mod.conc() end)
    |> Enum.filter(fn x -> Passport.verify?(x) == true end)
    |> length()
  end
end

defmodule List_mod do
  def conc([first | rest]) do
    conc(rest, first)
  end

  def conc([first | rest], list) do
    conc(rest, list ++ first)
  end

  def conc([], list) do
    list
  end
end

defmodule Passport do
  def verify?(passport) do
    case Enum.count(passport) do
      8 ->
        Enum.all?(passport, fn x -> section_verify?(x) end)

      7 ->
        !Enum.any?(passport, fn x -> String.contains?(x, "cid") end) and
          Enum.all?(passport, fn y -> section_verify?(y) end)

      _ ->
        false
    end
  end

  def section_verify?(section) do
    case String.slice(section, 0..2) do
      "byr" ->
        year_check?(section, 1920, 2002)

      "iyr" ->
        year_check?(section, 2010, 2020)

      "eyr" ->
        year_check?(section, 2020, 2030)

      "hgt" ->
        String.split(section, ":") |> height?()

      "hcl" ->
        String.match?(section, ~r/^hcl:#[a-f0-9]+$/)

      "ecl" ->
        String.trim(section, "ecl:") |> String.contains?("amb") or
          String.trim(section, "ecl:") |> String.contains?("blu") or
          String.trim(section, "ecl:") |> String.contains?("brn") or
          String.trim(section, "ecl:") |> String.contains?("gry") or
          String.trim(section, "ecl:") |> String.contains?("grn") or
          String.trim(section, "ecl:") |> String.contains?("hzl") or
          String.trim(section, "ecl:") |> String.contains?("oth")

      "pid" ->
        String.match?(section, ~r/^pid:[0-9]........$/)

      "cid" ->
        true

      _ ->
        false
    end
  end

  def height?([_section, value]) do
    case String.slice(value, -2..-1) do
      "cm" -> String.trim(value, "cm") |> height_add?(150, 193)
      "in" -> String.trim(value, "in") |> height_add?(59, 76)
      _ -> false
    end
  end

  def height_add?(value, min, max) do
    min_check = value |> String.to_integer() >= min
    max_check = value |> String.to_integer() <= max
    min_check and max_check
  end


  def year_check?(section, min, max) do
    min_check = String.slice(section, 4, 10) |> String.to_integer() >= min
    max_check = String.slice(section, 4, 10) |> String.to_integer() <= max
    min_check and max_check
  end
end
